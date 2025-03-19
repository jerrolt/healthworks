<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Message;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use App\Services\TwilioService;

class MessageController extends Controller
{
    protected $twilioService;
    public function __construct(TwilioService $twilioService)
    {
        $this->twilioService = $twilioService;
    }
    /**
     * 
     */
    function create(Request $request){
        return inertia('Message/Create');
    }

    /**
     *  Authenticate
     */
    function store(Request $request, Message $message){
        
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'phone_number' => 'required|digits:10',
            'files.*' => 'mimes:jpg,png,jpeg,pdf|max:5000'
        ],
        [
            'files.*.mimes'=>'The file must be jpg, png, pdf'
        ]);
        
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        
        $message = new Message();
        $message->user_id = 1;
        $secret = strtotime('now') . Str::random(10);
        $message->secret = md5($secret);
        $message->phone_number = $request->phone_number;
        $message->content = $request->content;
        $message->save();
      
        //UPLOAD AND SAVE FILES
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('files', 'private');
                $newFile = new File();
                $newFile->message_id = $message->id;
                $secret = strtotime('now') . Str::random(10);
                $newFile->secret = md5($secret);
                $newFile->extension = $file->extension();
                $newFile->expires_at = strtotime('+20 minutes');
                $newFile->path = $path;
                $newFile->filename = $file->getClientOriginalName();
                $newFile->mime = $file->getClientMimeType();
                $newFile->save();
            }
        }

        if(!$this->sendSms($message)){
            $validator->errors()->add('sms','Text SMS failed.');
            throw new ValidationException($validator);
        }
        return redirect()->route("message.delivered")
            ->with('success','Message delivered successfully')
            ->with('msg-secret',$message->secret);
    }


    /**
     * 
     */
    function show(Request $request, $secret){
        $message = Message::with('files')->where('secret',$secret)->first();
        return inertia('Message/Show', [
            'message' => $message,
        ]);
    }

    /**
     * 
     */
    function content(Request $request, $secret){
        $message = Message::with('files')->where('secret',$secret)->first();
        return inertia('Message/Content', [
            'message' => $message,
        ]);
    }

    /**
     * 
     */
    function delivered(Request $request){
        // $message = Message::with('files')->where('secret',$secret)->first();
        return inertia('Message/Delivered');
    }

    /**
     * 
     */
    protected function sendSms(Message $message){
        $smsPhoneNumber = "+1{$message->phone_number}";
        $smsContent = "{$message->content}\n\n".env('APP_URL');
        if(env('APP_PORT'))
            $smsContent .= ":".env('APP_PORT');
        $smsContent .= "/files/".$message->secret;

        return $this->twilioService->sendSms($smsPhoneNumber, $smsContent);
    }
    
}

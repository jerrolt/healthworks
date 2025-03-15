<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * 
     */
    function show(Request $request, $secret)
    {
        $file = File::where('secret',$secret)->first();
        if(strtotime('now') >= $file->expires_at)
        {
            return Inertia('File/Expired',[
                'secret'=>$secret
            ]);
        }
        
        $filepath = storage_path('app/private').'/'.$file->path;
        $visualFilename = $file->filename;
        return response()->streamDownload(function() use($filepath){
            readfile($filepath);
        }, $visualFilename);
        
        // $filePath = storage_path('app/private').'/'.$file->path;
        // return Storage::download($filePath);
    }
}

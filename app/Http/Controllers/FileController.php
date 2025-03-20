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
         
        $location = storage_path('app/private') . '/files/' . $file->filename . '.' . $file->extension;
        $filename = $file->filename . '.' . $file->extension;
        return response()->streamDownload(function() use($location){
            readfile($location);
        }, $filename);
    }
}

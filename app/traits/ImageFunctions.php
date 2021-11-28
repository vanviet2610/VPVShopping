<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ImageFunctions
{
    function getFileName_FilePath($modleRequest, $folder)
    {
        $fileNameHash = Str::random(30);
        $fileNameOfImage = $modleRequest->getClientOriginalName();
        $lastFilePath = $modleRequest->getClientOriginalExtension();
        $modleRequest->storeAs('public/' . $folder, $fileNameHash . '.' . $lastFilePath);
        return  [
            'file_name' => $fileNameOfImage,
            'file_path' => '/storage/' . $folder . '/' . $fileNameHash . '.' . $lastFilePath
        ];
    }

    function CreateLoadFile($reqFile, $nameFolder)
    {
        $fileName = Str::random(20);
        $fileNameOfImage = $reqFile->getClientOriginalName();
        $fileTail = $reqFile->getClientOriginalExtension();
        $folderDayUpload = date('Y-m-d');
        $reqFile->storeAs('public/' . $nameFolder . '/' . $folderDayUpload, $fileName . '.' . $fileTail);
        return  [
            'file_name' => $fileNameOfImage,
            'file_path' => '/storage/' . $nameFolder . '/' . $folderDayUpload . '/' . $fileName . '.' . $fileTail
        ];
    }
}

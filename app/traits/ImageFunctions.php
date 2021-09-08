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
}

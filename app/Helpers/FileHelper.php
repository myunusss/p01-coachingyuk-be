<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class FileHelper
{
    public static function isFileExist($file)
    {
        return isset($file) && $file != "null";
    }

    public static function uploadFile($file, $rootPath = 'categories')
    {
        $filename = Str::random(20);
        $mime = $file->getClientMimeType();

        $path = "$rootPath/" . date('Ymd') . '/';
        $file->storeAs(
            $path,
            $filename . '.' . $file->getClientOriginalExtension(),
            'public'
        );
        $filePath = $path . $filename . '.' . $file->getClientOriginalExtension();

        return $filePath;
    }
}

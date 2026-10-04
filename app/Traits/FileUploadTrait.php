<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    public function uploadFile(UploadedFile $file, ?string $oldpath = null, ?string $path = 'uploads'): ?string
    {
        if (!$file->isValid()) {
            return null;
        }

        $ignorPath = ['defaults/avatar.jpeg'];

        if($oldpath && File::exists(public_path($oldpath)) && !in_array($oldpath, $ignorPath)){
            File::delete(public_path($oldpath));
        }

        /* Créons maintenant le chemin pour le stockage des images */
        $folderPath = public_path($path);

        /* La définition de l'extension . */
        $fileName = Str::uuid(). '.' .$file->getClientOriginalExtension();

        $file->move($folderPath, $fileName);

        $filePath = $path.'/'.$fileName;

        return $filePath;
    }

    public function uploadPrivateFile(UploadedFile $file, ?string $path = 'uploads'): ?string
    {
        if (!$file->isValid()) {
            return null;
        }

        /* La définition de l'extension . */
        $fileName = Str::uuid(). '.' .$file->getClientOriginalExtension();

        $path = $file->storeAs($path, $fileName, 'local');

        return $path;
    }
}

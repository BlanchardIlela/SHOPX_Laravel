<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    public function uploadFile(UploadedFile $file, $path = 'uploads'): ?string
    {
        if (!$file->isValid()) {
            return null;
        }
        /* Créons maintenant le chemin pour le stockage des images */
        $folderPath = public_path($path);

        /* La définition de l'extension . */
        $fileName = Str::uuid(). '.' .$file->getClientOriginalExtension();

        $file->move($folderPath, $fileName);

        $filePath = $path.'/'.$fileName;

        return $filePath;
    }
}

<?php

namespace app\repositories;

use app\models\Image;

class ImageRepository
{
    /**
     * Checks the original names of the downloaded files with those saved in the database,
     * and if there is a match, saves the file under a unique (conditionally) name.
     * @param array<string, string> $images
     * @return bool
     */
    public function saveImages(array $images): bool
    {
        $resp = false;
        if($images) {
            $originalNames = collect($images)->pluck('baseName')->toArray();
            $takenNames = [];
            $takenNames = Image::findAll(['original_title' => $originalNames]);
            if($takenNames) {
                $takenNames = collect($takenNames)->pluck('original_title')->toArray();
            }
            foreach ($images as $file) {
                $fileName = $file->baseName;
                if(in_array($file->baseName, $takenNames)) {
                    $fileName = rand(0, 10000) . time() . rand(0, 10000);
                }
                $file->saveAs('../uploads/' . $fileName . '.' . $file->extension);
                $image = new Image();
                $image->title = $fileName;
                $image->original_title = $file->baseName;
                $resp = $image->save();
            }
        }
        return $resp;
    }
}

<?php

namespace app\repositories;

use app\models\Image;
use yii\helpers\Inflector;
use ZipArchive;

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
        if ($images) {
            $originalNames = collect($images)->pluck('baseName')->toArray();
            $takenNames = [];
            $takenNames = Image::findAll(['original_title' => $originalNames]);
            if ($takenNames) {
                $takenNames = collect($takenNames)->pluck('original_title')->toArray();
            }
            foreach ($images as $file) {
                $fileName = strtolower(Inflector::transliterate($file->baseName));
                if (in_array($file->baseName, $takenNames)) {
                    $fileName = rand(0, 10000) . time() . rand(0, 10000);
                }
                $file->saveAs('../uploads/' . $fileName . '.' . $file->extension);
                $image = new Image();
                $image->title = $fileName . '.' . $file->extension;
                $image->original_title = $file->baseName;
                if ($image->validate()) {
                    $resp = $image->save();
                }
            }
        }
        return $resp;
    }

    /**
     * Checks the existence of an image file and an archive file using the passed string, and if there is no archive, creates one.
     * Returns archive name or empty string on success.
     * @param string $imageFileTitle
     * @return string
     */
    public function getZipFile(string $imageFileTitle): string
    {
        $resp = '';
        if (file_exists('uploads/' . $imageFileTitle)) {
            $zipFileName = 'uploads/compressed/' . explode('.', $imageFileTitle)[0] . '.zip';
            if (!file_exists($zipFileName)) {
                $zipFile = new ZipArchive();
                $zipFile->open($zipFileName, ZipArchive::CREATE);
                $zipFile->addFile('uploads/' . $imageFileTitle);
                $res = $zipFile->close();
                if ($res) {
                    $resp = $zipFileName;
                }
            } else {
                $resp = $zipFileName;
            }
        }
        return $resp;
    }
}

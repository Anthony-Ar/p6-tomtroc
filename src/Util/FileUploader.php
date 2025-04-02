<?php

namespace App\Util;

use App\Exception\FileUploadError;

class FileUploader
{
    public const string UPLOAD_DIR = "/uploads/";

    /**
     * Utilitaire servant à upload des images
     * @param $file
     * @param int $maxSize
     * @return string
     * @throws FileUploadError
     */
    public static function upload($file, int $maxSize = 5) : string
    {
            if ($file["error"] !== UPLOAD_ERR_OK) {
                throw new FileUploadError('Erreur lors du chargement du fichier : ' . $file["error"]);
            }

            $maxSize = $maxSize * 1024 * 1024;

            if ($file["size"] > $maxSize) {
                throw new FileUploadError('Le fichier est trop volumineux');
            }

            $allowedTypes = ["image/jpeg", "image/png"];
            $fileMimeType = mime_content_type($file["tmp_name"]);

            if (!in_array($fileMimeType, $allowedTypes)) {
                throw new FileUploadError('Le fichier n\'est pas au bon format');
            }

            $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $newFileName = uniqid("img_", true) . "." . $fileExtension;
            $destinationPath = self::UPLOAD_DIR . $newFileName;

            if (move_uploaded_file($file["tmp_name"], $destinationPath)) {
                return $destinationPath;
            } else {
                throw new FileUploadError('Impossible d\'upload le fichier');
            }
    }
}

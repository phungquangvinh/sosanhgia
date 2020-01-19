<?php namespace Nht\Hocs\Core\Uploads;

use Nht\Hocs\Core\Uploads\Exceptions\UploadFolderDoesNotExistException;

class Uploader {

    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
    }

    public function upload($fileControl)
    {
        $pathUpload = $this->getUploadFolderPathToDay();
        return $this->upload->upload($fileControl, $pathUpload);
    }

    public function uploadFromUrl($url)
    {
        $pathUpload = $this->getUploadFolderPathToDay();
        return $this->upload->uploadFromUrl($url, $pathUpload);
    }

    public function uploadMulti($fileControl)
    {
        $pathUpload = $this->getUploadFolderPathToDay();
        return $this->upload->uploadMulti($fileControl, $pathUpload);
    }

    public function getUploadFolderPathToDay() {
        $pathUpload = $this->upload->getUploadFolderPath().'/'. date('Y').'/'.date('m').'/'.date('d');

        // Create folder if it not exist
        if(!is_dir($pathUpload)) {
            try {
                mkdir($pathUpload, 0777, true);
            } catch (\ErrorException $e) {
                throw new UploadFolderDoesNotExistException("Upload folder does not exist or you need chmod 777 to this folder", 1);
            }
        }

        return $pathUpload;
    }

}
<?php

namespace Nht\Hocs\Core\Images;

use Nht\Hocs\Core\Images\ImageFactory;

class ImageFactoryV2 extends ImageFactory {

	public function uploadFromLink($link, $arrayThumbs = [], $optional = 'resize')
	{
		if (empty($arrayThumbs))
		{
			$arrayThumbs = config('image.thumbs');
		}

		$return = [
			'status'   =>	0,
			'size'     =>	0,
			'filename' =>	'',
			'path'     =>	'',
			'thumbs'   =>	[]
		];
		$upload 		=	new \Nht\Hocs\Core\Uploads\Upload();
		$ext 			=	explode("/", $link);
		$orginal 	=	end($ext);
		$fileName 	=	$upload->generateNewFileName($orginal);

		/*
		if($upload->checkExtension($orginal) == false) {
			throw new Nht\Hocs\Core\Uploads\Exceptions\FileTypeIsNotAllowedException($upload->getExtensions());
		}*/

		$content 	=	@file_get_contents($link);
		if(!$content)
			throw new \Nht\Hocs\Core\Uploads\Exceptions\UploadPathDoesNotExistException("Đường dẫn không đúng định dạng (http:// hoặc https://).");

		$filesize 	=	strlen($content);
		if($filesize / 1024 > $upload->getFileSizeLimit())
		{
			throw new \Nht\Hocs\Core\Uploads\Exceptions\UploadMaxFileSizeException("Upload file tối đa " . $$upload->getFileSizeLimit() . " KB");
		}

		$pathUpload =	$this->upload->getUploadFolderPathToDay() . '/';
		$file 		=	@file_put_contents($pathUpload . $fileName, $content);
		if(!$file)
		{
			throw new \Nht\Hocs\Core\Uploads\Exceptions\UploadPathDoesNotExistException("Không tìm thấy hình ảnh, vui lòng thử lại.");
		}

		$thumbs = [];

		$pathUpload = $this->upload->getUploadFolderPathToDay() . '/';

		if($optional == 'resize')
		{
			 $thumbs = $this->image->resize($pathUpload . $fileName, $pathUpload, $arrayThumbs);
		}
		else if ($optional == 'crop')
		{
			 $thumbs = $this->image->crop($pathUpload . $fileName, $pathUpload, $arrayThumbs);
		}

		list($width, $height) = getimagesize($pathUpload . $fileName);
      $this->checkWidth($fileName);
		
		$return['status']   = 1;
		$return['thumbs']   = $thumbs;
		$return['filename'] = $fileName;
		$return['path']     = $pathUpload . $fileName;
		$return['size']     = filesize($pathUpload . $fileName);
		$return['width']    = $width;
		$return['height']   = $height;
		

		return $return;
	}
}
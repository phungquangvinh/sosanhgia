<?php namespace Nht\Hocs\Core\Uploads;


class Upload {

	protected $uploadFolder = 'uploads';

	public function __construct($config = []) {
		if (empty($config))
		{
			$config = (array) config('upload');
		}

		$this->extensions = array_get($config, 'extensions');
		$this->fileSize   = array_get($config, 'file_size');
		$this->uploadFolder = array_get($config, 'upload_folder', 'uploads');
	}

	/**
	 * Upload file
	 *
	 * @param  string $fileControl
	 * @param  path $pathUpload
	 *
	 * @return string|null
	 */
	public function upload($fileControl, $pathUpload) {
		//Duong dan luu anh
		$pathUpload = rtrim($pathUpload, '/') . '/';

		if(!isset($_FILES[$fileControl])) {
			throw new Exceptions\NoFileSelectedException("Chưa chọn file upload");
		}

		//Upload code
		$uploadErrorCode = $_FILES[$fileControl]['error'];

		if($uploadErrorCode > 0) {
			throw new Exceptions\UploadException($uploadErrorCode);
		}

		if($this->checkExtension($_FILES[$fileControl]['name']) == false) {
			throw new Exceptions\FileTypeIsNotAllowedException($this->getExtensions());
		}

		if($this->checkFilesizeLimit($_FILES[$fileControl]['size']) == false) {
			throw new Exceptions\UploadMaxFileSizeException($this->getFileSizeLimit());
		}

		if(!file_exists($pathUpload)) {
			throw new Exceptions\UploadPathDoesNotExistException("Đưòng dẫn upload không tồn tại. Bạn đã tạo folder lưu trữ file này chưa?");
		}

		$newFileName = $this->generateNewFileName($_FILES[$fileControl]['name']);

		if(move_uploaded_file($_FILES[$fileControl]['tmp_name'], $pathUpload . $newFileName)) {
			return $newFileName;
		}
	}



	/**
	 * Upload multiple
	 * @param  [type] $fileControl [description]
	 * @param  [type] $pathUpload  [description]
	 * @param  array  $arrayResize [description]
	 * @param  string $action      [description]
	 * @return [type]              [description]
	 */
	public function uploadMulti($fileControl, $pathUpload) {
		$arrayResult = array();
		$pathUpload = rtrim($pathUpload, '/') . '/';
		foreach ($_FILES[$fileControl]["error"] as $key => $error) {
		   if ($error == UPLOAD_ERR_OK
		   	&& in_array($this->getExtension($_FILES[$fileControl]["name"][$key]), $this->getExtensions())) {
				$tmp_name = $_FILES[$fileControl]["tmp_name"][$key];
				$name     = $this->generateNewFileName($_FILES[$fileControl]["name"][$key]);
				move_uploaded_file($tmp_name, $pathUpload . $name);

				$arrayResult[] = $name;
		   }
		}

		return $arrayResult;
	}

	public function uploadFromUrl($url, $pathUpload)
	{
		$parseUrl = parse_url($url);
		$url = $parseUrl['scheme'].'://'.$parseUrl['host'].$parseUrl['path'];
		if( ! $this->checkExtension($url) ) {
			return false;
		}

		// Tạo file tạm
		$tempContent = @file_get_contents($url);
		$tempFileFath = $this->getUploadFolderPath().'/temp.'.$this->getExtension($url);
		@file_put_contents($tempFileFath, $tempContent);

		// Từ file tạm tạo 1 file mới
		$newFileName = $this->generateNewFileName($tempFileFath);
		$newFilePath = $pathUpload.'/'.$newFileName;

		@file_put_contents($newFilePath, $tempContent);

		// Xóa file tạm
		@unlink($tempFileFath);

		if( is_readable($newFilePath) ) {
			return [
				'code' => 200,
				'extension' => $this->getExtension($newFilePath),
				'old_name' => basename($url),
				'filename' => $newFileName,
				'size' => filesize($newFilePath)
			];
		}

		return false;
	}


	/**
	 * Get extension
	 * @param  string $filename
	 * @return mixed
	 */
	public function getExtension($filename) {
		$info = new \SplFileInfo($filename);
		return strtolower($info->getExtension());
	}


	/**
	 * Generate new file name
	 *
	 * @param  string $filename
	 *
	 * @return string
	 */
	public function generateNewFileName($filename) {
		$ipClient = time() .uniqid() . rand(111111,999999) . rand(111111,999999);

		$frefix = date("Y_m_d").'___'.time().'___';
		$nFilename = str_replace('.', '--', $filename);
		$nFilename = removeTitle($nFilename);
		$filenameMd5 = $frefix . md5($nFilename . $ipClient);

		return $filenameMd5 . '.' . $this->getExtension($filename);
	}


	/**
	 * Get config extensions
	 *
	 * @return array
	 */
	public function getExtensions() {
		return $this->extensions;
	}

	/**
	 * Get config limit file size
	 *
	 * @return integer
	 */
	public function getFileSizeLimit() {
		return $this->fileSize;
	}


	/**
	 * Kiem tra extension
	 * @param  [type] $filename [description]
	 * @return [true | false]           [description]
	 */
	public function checkExtension($filename) {
		$extension = $this->getExtension($filename);

		if(!in_array($extension, $this->extensions)){
			return false;
		}

		return true;
	}


	/**
	 * Kiem tra dung luong upload cho phep
	 * @param  [type] $filename [description]
	 * @return [true | false]           [description]
	 */
	public function checkFilesizeLimit($size) {
		if($size / 1024 > $this->fileSize){
			return false;
		}

		return true;
	}

	public function getUploadFolder() {
		return $this->uploadFolder;
	}

	public function getUploadFolderPath() {
		return ROOT  . '/public/' . $this->getUploadFolder();
	}
}
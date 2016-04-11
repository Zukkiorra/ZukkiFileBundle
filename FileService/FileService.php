<?php

Class FileService 
{
	private $extensions;
	private $file;
	private $location;

	public function setFile($file)
	{
		$this->file = $file['file'];
	}

	public function setExtensions($extensions)
	{
		$this->extensions = $extensions;
	}

	public function setLocation($location)
	{
		$this->location = $location;
	}

	public function checkExtension($extension)
	{
		return in_array($extension, $this->extensions);
	}

	public function getExtension()
	{
		$pathInfo = pathinfo($this->file['name']);
		return $pathInfo['extension'];
	}

	public function saveFile($randStringHash, $extension, $chmod)
	{
		$fullPath = $this->location.$randStringHash.".".$extension;
		if(move_uploaded_file($this->file['tmp_name'], $fullPath)) {
			chmod($fullPath, $chmod);
			return 1;
		} else {
			return 0;
		}
	}
}

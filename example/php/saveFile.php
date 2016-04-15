<?php
	require '../../FileService/FileService.php';
	require '../../vendor/RandomStringGenerator/RandomStringGenerator.php';

	$file = $_FILES;

	$fileService = new FileService();
	$fileService->setFile($file);
	$fileService->setExtensions(['jpg','png','jpeg', 'mp3']);
	$fileService->setLocation("../file_storage/");
	$extension = $fileService->getExtension();
	$randStrGen = new RandomStringGenerator();
	$maxSize = 3 * pow(1024,2);

	if($fileService->checkExtension($extension)) {
		if ($maxSize > $fileService->getFileSize()) {
			$randStrGen->setRandomString(30);
			$randString = $randStrGen->getRandomString();
			$randStrGen->setStringHash("md5", $randString);
			$randStringHash = $randStrGen->getStringHash();

			$fileService->setChmod(0777);
			$message = $fileService->saveFile($randStringHash, $extension);
		} else {
			$message = 3;
		}
	} else {
		$message = 2;
	}

	echo $message;

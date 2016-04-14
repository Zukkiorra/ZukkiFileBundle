<?php
	require '../../FileService/FileService.php';
	require '../../vendor/RandomStringGenerator/RandomStringGenerator.php';

	$file = $_FILES;

	$fileService = new FileService();
	$fileService->setFile($file);
	$fileService->setExtensions(['jpg','png','jpeg']);
	$fileService->setLocation("../file_storage/");
	$extension = $fileService->getExtension();
	$randStrGen = new RandomStringGenerator();

	if($fileService->checkExtension($extension)) {
		$randStrGen->setRandomString(30);
		$randString = $randStrGen->getRandomString();
		$randStrGen->setStringHash("md5", $randString);
		$randStringHash = $randStrGen->getStringHash();

		$fileService->setChmod(0777);
		$message = $fileService->saveFile($randStringHash, $extension);
	} else {
		$message = 2;
	}

	echo $message;

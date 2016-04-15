<?php
	require '../../FileService/FileService.php';
	require '../../vendor/RandomStringGenerator/RandomStringGenerator.php';

	$file = $_FILES;
	$fileService = new FileService();
	$randStrGen = new RandomStringGenerator();

	$fileService->setLocation("../file_storage/");
	$fileMaxSizes = ['file' => 3, 'file2' => 4];
	$fileExtensions = ['file' => ['jpg','png','jpeg', 'mp3'], 'file2' => ['mp3', 'mp4']];

	//validator
	$validationIndex = 0;
	foreach ($file as $uplFileKey => $uplFileData) {
		//set file
		$fileService->setFile($file[$uplFileKey]);
		//set allowed extensions
		$fileService->setExtensions($fileExtensions[$uplFileKey]);
		//get extension
		$extension = $fileService->getExtension();

		//check extension
		if($fileService->checkExtension($extension)) {
			$validationIndex = 1;
		} else {
			$message = [2,$uplFileKey];
			$validationIndex = 0;
			break;
		}

		//check file size
		$maxSize = $fileMaxSizes[$uplFileKey] * pow(1024,2);
		if ($maxSize > $fileService->getFileSize()) {
			$validationIndex = 1;
		} else {
			$message = [3,$uplFileKey];
			$validationIndex = 0;
			break;
		}
	}

	//save file
	if ($validationIndex == 1) {
		foreach ($file as $uplFileKey => $uplFileData) {
			$fileService->setFile($file[$uplFileKey]);
			$extension = $fileService->getExtension();
			//generate random string for file name
			$randStrGen->setRandomString(30);
			$randString = $randStrGen->getRandomString();
			$randStrGen->setStringHash("md5", $randString);
			$randStringHash = $randStrGen->getStringHash();

			$fileService->setChmod(0777);
			$message = [$fileService->saveFile($randStringHash, $extension)];
		}
	}

	echo json_encode($message);

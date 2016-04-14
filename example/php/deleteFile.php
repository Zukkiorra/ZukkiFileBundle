<?php
	require '../../FileService/FileService.php';

	$fileName = addslashes($_POST['file_name']);

	$fileService = new FileService();

	$fileService->setLocation("../file_storage/");
	$fileService->setChmod(0777);

	$message = $fileService->deleteFile($fileName);

	echo $message;
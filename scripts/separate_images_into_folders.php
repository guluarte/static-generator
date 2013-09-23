<?php
$source = "./images/";
$maxFilesPerDir = 1000;

$cont = 0;
$roundNumber = 0;
$roundNumber = round( ($cont/$maxFilesPerDir),0);
$newFolder = "";
$listImages = array();
$newFolder = $source . ($roundNumber + 1) . "/";
@mkdir($newFolder);
$listImages = scandir($source);
foreach ($listImages as $imageFile) {
	if ($imageFile != "." && $imageFile != ".." && is_file($source.$imageFile)) {
		$oldFile = $source.$imageFile;
		$newImageFile = $newFolder . $imageFile;
		echo "Moving file to ".$oldFile." to ".$newImageFile .PHP_EOL;
		rename($oldFile, $newImageFile);
		echo $cont++;
		if ($cont % $maxFilesPerDir == 0) {
			$roundNumber = round( ($cont/$maxFilesPerDir),0);
			$newFolder = $source . ($roundNumber + 1) . "/";
			@mkdir($newFolder);
		}
	}
}

echo "\nDone\n";


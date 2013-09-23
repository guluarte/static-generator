<?php
#s3cmd put --acl-public --guess-mime-type -P 1/* s3://funnythings247.com/images/

$source = "./thumbs/";

$cmds = "";
$dirs = scandir($source);
foreach ($dirs as $dir) {
	if ($dir != "." && $dir != ".." && is_dir($source.$dir)) {

		$cmd = "s3cmd put --acl-public --guess-mime-type -P ".$source . $dir."/* s3://funnythings247.com/images/". PHP_EOL;
		$cmds .= $cmd;
		echo $cmd;
	}


}
file_put_contents("upload-dirs-images.sh", $cmds);
echo "Done". PHP_EOL;



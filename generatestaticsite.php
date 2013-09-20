<?php
require("bootstrap.php");

$file = "lolzbook.json";
$theme = "funny";
$source = "./source";
$public = "./public";

$fp = fopen($file, 'r');
$generator = new Qrubit\StaticPageGenerator('funny', $source, $public);
$generator->setSiteAuthor("Funny Things");
$generator->setSiteName("Funny Things 24/7");
$generator->setSiteUrl("http://funnythings247.com");
$generator->setSiteImagePath("http://funnythings247.com/images/");
$cont = 0;
while (!feof($fp)) {
	$json = trim(fgets($fp));
	$array = json_decode($json, true);
	$post = array(
		'title' => $array['title'],
		'image' => $array['filename'],
		'tags' =>  $array['categories'],
		'category' => $array['categories'][0],
		);
	$generator->addPost($post);
	echo "..";
	$cont++;
	if ($cont > 50) {
		break;
	}
	
}
$generator->generate();

deploy("funnythings247", $public);

function deploy($bucket, $public) {
	$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$public."/* s3://".$bucket."/ --exclude 'assets/'";
	echo $deployCmd."\n";
	system($deployCmd);
	$deployCmd = "s3cmd sync --acl-public --guess-mime-type -P ".$public."/assets/* s3://".$bucket."/assets/ --add-header 'Cache-Control: public, max-age=31600000'";
	system($deployCmd);
}

echo "Done";


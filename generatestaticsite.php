<?php
require("bootstrap.php");

$file = "lolzbook.json";
$theme = "funny";
$source = "./source";
$public = "./public";
$bucket = "funnythings247.com";

$fp = fopen($file, 'r');
$generator = new Qrubit\StaticPageGenerator('funny', $source, $public, true);
$generator->setSiteAuthor("Funny Things");
$generator->setSiteName("Funny Things 24/7");
$generator->setSiteUrl("http://funnythings247.com");
$generator->setSiteImagePath("http://funnythings247.com/images/");

$generator->addCustomFiles('privacy.php', 'privacy.html', array(
	'title' => "Privacy Policy",
));
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
	$cont++;
	if ($cont > 20) {
		//break;
	}
	
}

$generator->generate();
$generator->deploy($bucket);
echo "Done.\n Run ./deploy.sh\n";


<?php
require("bootstrap.php");

$theme = "funny";
$source = "./source";
$public = "./public";
$bucket = "funnythings247.com";


$generator = new Qrubit\StaticPageGenerator('funny', $source, $public, true);
$generator->setSiteAuthor("Funny Things");
$generator->setSiteName("Funny Things 24/7");
$generator->setSiteUrl("http://funnythings247.com");
$generator->setSiteImagePath("http://funnythings247.com/images/");
$generator->setLang('en_US');
$generator->addCustomFiles('privacy.php', 'privacy.html', array(
	'title' => "Privacy Policy",
	));

addPostFromFile("lolzbook.json", $generator);

$generator->setRandomize();


function addPostFromFile($file, $generator) {
	if (!file_exists($file)) {
		return false;
	}
	#system("tac ".$file." > ".$file.".rev");
	$fp = fopen($file, 'r'); //open the file in reverse
	$cont = 0;
	while (!feof($fp)) {
		$json = trim(fgets($fp));
		$array = json_decode($json, true);
		if ( !strstr($array['title'], "http://")) {
			$post = array(
				'title' => $array['title'],
				'image' => $array['filename'],
				'tags' =>  $array['categories'],
				'category' => $array['categories'][0],
				);
			$generator->addPost($post);
			$cont++;
			if ($cont > 200) {
				#break;
			}
		}


	}
	fclose($fp);
	#unlink($file.".rev");
}

$generator->generate();
$generator->deploy($bucket);
echo "Done.\n Run ./deploy.sh\n";


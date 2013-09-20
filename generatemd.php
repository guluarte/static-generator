<?php
include('./vendor/autoload.php');

use Symfony\Component\Yaml\Yaml;

$file = "lolzbook.json";
$fp = fopen($file, 'r');
while (!feof($fp)) {
	$json = trim(fgets($fp));
	$array = json_decode($json, true);
	buildMd($array);
	//echo $filename."\n";
}

function buildMd($array) {
	if ( isset($array['title'])) {
		$array['title'] = trim($array['title']);
	}
	if ($array['postfilename'] == null 
		|| $array['title'] == null
		|| count($array['categories']) == 0
		|| $array['filename'] == null
		|| strlen($array['postfilename']) > 200
		) {
		return;
	}
	$filename = './_posts/'.$array['postfilename'];

	$strToLowerTitle = strtolower($array['title']);

	$array['title'] = ( $strToLowerTitle == 'no') ? "No." : $array['title'];
	$array['title'] = ( $strToLowerTitle == 'yes') ? "Yes." : $array['title'];
	$array['title'] = ( $strToLowerTitle == 'true') ? "True." : $array['title'];
	$array['title'] = ( $strToLowerTitle == 'false') ? "False." : $array['title'];

	$htmlTitle = trim(htmlentities($array['title'], ENT_QUOTES, 'UTF-8'));
	$post = array(
		'layout' => 'post',
		'category' => $array['categories'][0],
		'image' => $array['filename'],
		'tags' => $array['categories'],
		'title' => $htmlTitle,
		);
	$yamlStr = Yaml::dump($post);
	$output = "---". PHP_EOL;
	$output .= $yamlStr;
	$output .= "---". PHP_EOL;

	$output .= "<p>". $htmlTitle ."</p>" . PHP_EOL;
	file_put_contents($filename, $output);
}


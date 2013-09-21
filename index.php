<?php
require_once __DIR__.'/../vendor/autoload.php'; 

$app = new Silex\Application(); 

/* Index */
$app->get('/', function() use($app) { 
	return 'Hello '; 
});

/* New site page */
$app->post('/post', function (Request $request) {
	#We need title, image, tags and category
	$message = $request->get('title');
    //mail('feedback@yoursite.com', '[YourSite] Feedback', $message);
	$subRequest = Request::create('/', 'GET');
	return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
});




$app->run(); 
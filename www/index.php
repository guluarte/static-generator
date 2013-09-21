<?php
require_once __DIR__.'/../vendor/autoload.php'; 

use Silex\Provider\FormServiceProvider;
use Qrubit\Entry;

$app = new Silex\Application(); 
$app['debug'] = true;
$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => '../app/views',
));
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

/* Index */
$app->get('/', function() use($app) { 
    // some default data for when the form is displayed the first time
    $data = array(
        'name' => 'Your name',
        'email' => 'Your email',
    );

    $form = $app['form.factory']->createBuilder('form', $data)
        ->add('name')
        ->add('email')
        ->add('gender', 'choice', array(
            'choices' => array(1 => 'male', 2 => 'female'),
            'expanded' => true,
        ))
        ->getForm();


    // display the form
    return $app['twig']->render('index.html', array('form' => $form->createView()));
});

$app->match('/add', function (Request $request) use ($app) {
    // some default data for when the form is displayed the first time
    $data = array(
        'name' => 'Your name',
        'email' => 'Your email',
    );

    $form = $app['form.factory']->createBuilder('form', $data)
        ->add('name')
        ->add('email')
        ->add('gender', 'choice', array(
            'choices' => array(1 => 'male', 2 => 'female'),
            'expanded' => true,
        ))
        ->getForm();

    if ('POST' == $request->getMethod()) {
        $form->bind($request);

        if ($form->isValid()) {
            $data = $form->getData();

            // do something with the data

            // redirect somewhere
            return $app->redirect('...');
        }
    }

    // display the form
    return $app['twig']->render('index.html', array('form' => $form->createView()));
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
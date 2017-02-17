<?php

require ('vendor/autoload.php');
require('app/install.php');
/*
spl_autoload_register(function ($classname) {
require (__DIR__ . '/../src/Models/' . $classname . ".php");
});*/
// set timezone for timestamps etc
date_default_timezone_set('UTC');

session_start();

$app = new \Slim\App([
	'settings' => [
	'displayErrorDetails' => true
      ]
]);
require('app/container.php');


$container = $app->getContainer();
/*
$app->add(new \App\Middlewares\FlashMiddleware($container->view->getEnvironment()));
$app->add(new \App\Middlewares\OldMiddleware($container->view->getEnvironment()));
$app->add(new \App\Middlewares\TwigCsrfMiddleware($container->view->getEnvironment(),$container->csrf));
$app->add($container->csrf);*/


$app->get('/', \App\Controllers\PagesController::class . ':home')->setName('root');

$app->get('/show', \App\Controllers\Postcontroller::class . ':index');

$app->get('/showinsert',\App\Controllers\Postcontroller::class . ':getstore')->setName('insert');
$app->post('/showinsert',\App\Controllers\Postcontroller::class . ':store');

$app->get('/showdelete',\App\Controllers\Postcontroller::class . ':getdelete');
$app->post('/showdelete',\App\Controllers\Postcontroller::class . ':delete')->setName('delete');

$app->get('/showupdate',\App\Controllers\Postcontroller::class . ':getupdate')->setName('update');
$app->post('/showupdate',\App\Controllers\Postcontroller::class . ':update');

$app->get('/showone',\App\Controllers\Postcontroller::class . ':showone');


//$app->get('/insert',\App\Controllers\Postcontroller::class . ':store');/
//$app->get('/show', ['\App\Controllers\Postcontroller', 'alltoshow']);

$app->get('/up',\App\Controllers\Postcontroller::class . ':update');
$app->get('/del',\App\Controllers\Postcontroller::class . ':delete');
$app->put('/update/:id', function($id)use($app){
    $ctgr = CategoryEloquent::find($id);
    $ctgr->name_category = $app->request->put('name_category');
    echo $ctgr->save();
});
$app->delete('/hapsus/:id', function($id){
 echo CategoryEloquent::find($id)->delete();
});

$app->run();			
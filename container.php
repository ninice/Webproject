<?php
$container = $app->getContainer();

$container['debug'] = function() {
    return true;
};

$container['csrf'] = function (){
    return new \Slim\Csrf\Guard();
};
//use($app)

$container['db'] = function ($container) use ($capsule){
    return $capsule;
};

$container['view'] = function ($container) {
	$dir = dirname(__DIR__);
	$view = new \Slim\Views\Twig($dir . '/app/views', [
			'cache' => $container->debug ? false : $dir . '/tmp/cache',
		'debug' => $container->debug
    ]);

	if($container->debug){
               $view->addExtension(new Twig_Extension_Debug());
		
	};

     $basePath = rtrim(str_ireplace('index.php', '', ($container['request']->getUri()->getBasePath())), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'],$basePath ));

    return $view;

};
/**
 * @param $container
 * @return mixed
 */
$container['mailer'] = function ($container) {

  //  if ($container->debug){
        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465,'ssl')
            ->setUsername('ellesheye@gmail.com')
            ->setPassword('chrissandra');
  
       /*  } else {

        $transport = Swift_MailTransport::newInstance();
    }*/
    $mailer = Swift_Mailer::newInstance($transport);
    return $mailer;
};	
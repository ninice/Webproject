<?php
$app = new \Slim\App();
$container = $app->getContainer();

$container['debug'] = function() {
    return true;
};

$container['csrf'] = function (){
    return new \Slim\Csrf\Guard();
};
$container['view'] = function ($container) {
	$dir = dirname(__DIR__);
    $view = new \Slim\Views\Twig($dir . '/app/views', [
        'cache' => $container->debug ? false : $dir . '/tmp/cache',
        'debug' => $container->debug
    ]);
    if($container->debug){
        $view->addExtension(new Twig_Extension_Debug());
    }
    $uri = $request->getUri();
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', ($container['request']->uri->getBasePath())), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

/**
 * @param $container
 * @return mixed
 */
$container['mailer'] = function ($container) {

    if ($container->debug){
        $transport = Swift_SmtpTransport::newInstance('localhost', 1025);
          /*  ->setUsername('info@domain.nl')
            ->setPassword('Password');*/
    } else {

        $transport = Swift_MailTransport::newInstance();
    }
    $mailer = Swift_Mailer::newInstance($transport);
    return $mailer;
};
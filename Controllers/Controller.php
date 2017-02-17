<?php
  
namespace App\Controllers;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SimpleXMLElement;

class Controller {
  

	private $container;

	public function __construct($container)
	{
      $this->container = $container;
	} 
   

  public function render(ResponseInterface $response, $file, $params = [])
  {
      $this->container->view->render($response, $file, $params);
  }

  public function redirect($response, $name, $status = 302){
	    return $response->withStatus($status)->withHeader('Location', $this->router->pathFor($name));
  }

  public function __get($name) {
      return $this->container->get($name);
  }
} 
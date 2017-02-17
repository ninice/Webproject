<?php
 namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator;

class PagesController extends Controller {

 
   
    public function home(RequestInterface $request, ResponseInterface $response)  {

     $this->render($response, 'pages/home.twig');
 }

  

    public function show(RequestInterface $request, ResponseInterface $response)  {

        return $this->render($response, 'pages/posts.twig');
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
   
}	
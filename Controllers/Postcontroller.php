<?php

namespace App\Controllers;

use App\Models\Post;
use App\Controllers\Controller;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Database\DatabaseInterface;
use Respect\Validation\Validator;

class 	PostController extends Controller
{
    /**
     * Create a new table instance.
     *
     * @param  Request  $request

     * @return Response
     */
    

    public function index(Request $request, Response $response)
    {   
       
         
         $result = json_decode(Post::all()->toJson(), true);
         print_r(var_dump($result));
  
        return $this->render( $response, 'pages/posts.twig');
    }
      

     public function getstore(Request $request, Response $response)
    {

        return $this->render( $response, 'pages/showinsert.twig');
       
    }
    public function store(Request $request, Response $response)
    {
         
        $category = new Post;

        $category->fill(['name' =>  $_POST['insert']]);

        $category->save();
     
        return $this->redirect($response, 'insert');
       
    }

     public function showone(Request $request, Response $response)
    {   
     
         $result = json_decode(Post::find(0)->toJson(), true);
         print_r(var_dump($result));
  
        return $this->render( $response, 'pages/showone.twig');
       
    }
 

     public function getupdate(Request $request, Response $response)
    {

        return $this->render( $response, 'pages/showupdate.twig');
       
    }

  public function update(Request $request, Response $response)
    {
      $category = Post::find($_POST['update-id']);

     $category->name =$_POST['updatename'];
     $category->updated_at = $timestamps;
      $category->save();
      return $this->redirect($response, 'update');
  }

    
     public function getdelete(Request $request, Response $response)
    {

        return $this->render( $response, 'pages/showdelete.twig');
       
    }
 public function delete(Request $request, Response $response)
    {
    Post::destroy($_POST['delete']);
    return $this->redirect($response, 'delete');
   }
}			
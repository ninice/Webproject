<?php
/**
 * Created by IntelliJ IDEA.
 * User: paule
 * Date: 26/11/2016
 * Time: 02:46
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


 class Post extends Model{
     protected $table = "category";
     protected $primaryKey = "id_category";
  //   protected $connection = 'connection-name';
      
     
     public $timestamps = true;
     protected $fillable = ['name'];

   //  protected $dateFormat = 'U';

     
 }
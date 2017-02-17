<?php

use Illuminate\Database\Capsule\Manager as Capsule;


function DBConnection(){
	return new PDO('mysql:dbhost=mysql.hostinger.fr; dbname=u106668785_advia','u106668785_advia','password');
}

DBConnection();
$capsule = new Capsule;
$capsule->addConnection(array(
		'driver'    => 'mysql',
		'host'      => 'mysql.hostinger.fr',
		'database'  => 'u106668785_advia',
		'username'  => 'u106668785_advia',
		'password'  => 'password',
		'charset'   => 'utf8',
		'collation' => 'utf8_general_ci',
		'prefix'    => ''
));

$capsule->setAsGlobal();
$capsule->bootEloquent();


 


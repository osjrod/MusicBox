<?php 
require 'vendor/autoload.php';  
 
use Illuminate\Database\Capsule\Manager as Capsule;  
 
$capsule = new Capsule; 
 
$capsule->addConnection(array(
	'driver'   => 'pgsql',
	'host'     => 'localhost',
	'database' => 'converter',
	'username' => 'postgres',
	'password' => 'jrod',
	'charset'  => 'utf8',
	'prefix'   => '',
	'port'     => '5432',
	'schema'   => 'public',
));
 
$capsule->bootEloquent(); 

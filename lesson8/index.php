<?php

spl_autoload_register(function($name){
	$path = str_replace('\\', '/', $name) . '.php';
	include_once($path);
});

include_once('vendor/autoload.php');
include_once('bootstrap.php');

use Bramus\Router\Router;
use Core\Exceptions\E404;

try{
	$router = new Router();
	$router->setNamespace('\App\Controllers');
	
	$registerRoutes = include('routes/web.php');
	$registerRoutes($router);
	
	$router->run();
}
catch(E404 $e){
	$router->trigger404();
}
catch(Throwable $e){
	echo 'Oops, some error, admin is called!';
	var_dump($e);
	// log::write($e)
}
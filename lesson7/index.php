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
	
	$router->get('/', 'CashPayments@index');
	$router->get('/payments/(\d+)', 'CashPayments@show');
	$router->match('GET|POST', '/payments/create', 'CashPayments@create');
	$router->match('GET|POST', '/payments/(\d+)/edit', 'CashPayments@edit');
	
	$router->set404('System@error404');
	
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
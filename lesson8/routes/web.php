<?php

use Bramus\Router\Router;

return function(Router $router){
	$router->get('/', 'CashPayments@index');
	$router->get('/payments/(\d+)', 'CashPayments@show');
	$router->match('GET|POST', '/payments/create', 'CashPayments@create');
	$router->match('GET|POST', '/payments/(\d+)/edit', 'CashPayments@edit');
	
	$router->set404('System@error404');
};
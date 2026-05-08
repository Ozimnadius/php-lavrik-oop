<?php

use Classes\Animal;
use Classes\User;

spl_autoload_register(function($name){
	$path = str_replace('\\', '/', $name) . '.php';
	include_once($path);
});

$user = new User(1, 'a', 'admin', 0);
$cat = new Animal('Murzik', 100, 10);

$user->niceLog();
$cat->log();
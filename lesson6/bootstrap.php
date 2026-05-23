<?php

spl_autoload_register(function($name){
	$path = str_replace('\\', '/', $name) . '.php';
	include_once($path);
});
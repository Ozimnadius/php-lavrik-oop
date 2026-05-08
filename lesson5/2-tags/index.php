<?php

use CustomTags\A;
use CustomTags\Div;
use SafetyHTML\TextNode;
use System\Event;

spl_autoload_register(function($name){
	$path = str_replace('\\', '/', $name) . '.php';
	include_once($path);
});

$root = new Div();

$root->addEventListener('rendered', function(Event $e){
	echo 'here';
});

$root->addEventListener('rendered', function(Event $e){
	echo 'here 2';
});

$root->appendChild((new A())->attr('href', '#')->appendChild(new TextNode('Hi!')));

if($root->isValid()){
	echo $root->render();
}

$root->dispatchEvent(new Event('rendered'));

function report(?string $message = null){
	static $reports = [];

	if($message === null){
		echo '<pre>';
		print_r($reports);
		echo '</pre>';
		return $reports;
	}
	else{
		$reports[] = $message;
	}
}

report(); 
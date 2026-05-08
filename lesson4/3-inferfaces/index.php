<?php

/* stupied without autoload */

include_once('SafetyHTML/Node.php');
include_once('SafetyHTML/Tag.php');
include_once('SafetyHTML/SingleTag.php');
include_once('SafetyHTML/PairTag.php');
include_once('SafetyHTML/TextNode.php');
include_once('SafetyHTML/Parser.php');
include_once('CustomTags/Img.php');
include_once('CustomTags/Div.php');
include_once('CustomTags/A.php');
include_once('CustomTags/Ul.php');
include_once('CustomTags/Li.php');

$realInp = '{"name":"div","attrs":[],"children":[{"name":"img","attrs":{"src":"nz","alt":"hz"}},"Hello,World!",{"name":"a","attrs":{"href":"1"},"children":["link"]},{"name":"ul","attrs":[],"children":[{"name":"li","attrs":[],"children":["Hello"]}]}]}';

$parser = new Parser();
$parser->registerTag('img', Img::class);
$parser->registerTag('div', Div::class);
$parser->registerTag('a', A::class);
$parser->registerTag('ul', Ul::class);
$parser->registerTag('li', Li::class);
$node = $parser->run($realInp);

if($node->isValid()){
	echo $node->render();
}

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

interface Some1{
	public function a(int $a) : string;
}
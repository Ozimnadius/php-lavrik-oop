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

$realInp = '{"name":"div","attrs":[],"children":[{"name":"img","attrs":{"src":"nz","alt":"hz"}},"Hello,World!",{"name":"a","attrs":{"href":"1"},"children":["link"]}]}';

$parser = new Parser();
$parser->registerTag('img', Img::class);
$parser->registerTag('div', Div::class);
$parser->registerTag('a', A::class);
$node = $parser->run($realInp);

if($node->isValid()){
	echo $node->render();
}

/* class Img extends SingleTag{
	protected function name() : string {
		return 'img';
	}

	protected function requiredAttrs() : array {
		return ['src', 'alt'];
	}
}

class Div extends PairTag{
	protected function name() : string {
		return 'div';
	}
} 

$img = new Img('img');
$img->attr('src', '1.jpg')->attr('alt', 'n">z<h1>111</h1><img src="');
$div = new Div();
$div ->attr('src', '1.jpg')->appendChild($img);

if($div->isValid()){
	echo $div->render();
} */
 

/* */
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
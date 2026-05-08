<?php

/* stupied without autoload */

use SafetyHTML\Parser;

include_once('SafetyHTML/ContentGroups.php');
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
include_once('CustomTags/Strong.php');

$realInp = '{"name":"div","attrs":[],"children":[{"name":"img","attrs":{"src":"nz","alt":"hz"}},"Hello,World!",{"name":"a","attrs":{"href":"1"},"children":["link"]},{"name":"ul","attrs":[],"children":[{"name":"li","attrs":[],"children":[{"name":"strong","attrs":{},"children":["Hello",{"name":"a","attrs":{"href":"1"},"children":["AAA here"]}]}]}]}]}';

$parser = new Parser();
$parser->registerTag('img', \CustomTags\Img::class);
$parser->registerTag('div', \CustomTags\Div::class);
$parser->registerTag('a', \CustomTags\A::class);
$parser->registerTag('ul', \CustomTags\Ul::class);
$parser->registerTag('li', \CustomTags\Li::class);
$parser->registerTag('strong', \CustomTags\Strong::class);
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
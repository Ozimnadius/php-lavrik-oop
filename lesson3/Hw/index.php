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
include_once('CustomTags/P.php');
include_once('CustomTags/Ul.php');
include_once('CustomTags/Li.php');

$realInp = '{"name":"div","attrs":{"class":"container"},"children":[{"name":"img","attrs":{"src":"photo.jpg","alt":"A photo"}},{"name":"p","attrs":{"id":"intro"},"children":["Hello, World!"]},{"name":"ul","attrs":{"class":"list"},"children":[{"name":"li","attrs":{},"children":["First item"]},{"name":"li","attrs":{},"children":["Second item"]}]},{"name":"a","attrs":{"href":"https://example.com"},"children":["Click here"]}]}';

$parser = new Parser();
$parser->registerTag('img', Img::class);
$parser->registerTag('div', Div::class);
$parser->registerTag('a', A::class);
$parser->registerTag('p', P::class);
$parser->registerTag('ul', Ul::class);
$parser->registerTag('li', Li::class);
$node = $parser->run($realInp);

if ($node->isValid()) {
    echo $node->render();
}

// Тест 1: Ul с детьми Li — должен быть валиден
$ul = new Ul();
$ul->appendChild((new Li())->appendChild(new TextNode('Item 1')))
   ->appendChild((new Li())->appendChild(new TextNode('Item 2')));

echo '<h3>Test 1: Ul + Li (valid)</h3>';
if ($ul->isValid()) {
    echo $ul->render();
} else {
    echo 'Invalid';
}
report();

// Тест 2: Ul с ребёнком Div — должен быть невалиден
$ul2 = new Ul();
$ul2->appendChild((new Div())->appendChild(new TextNode('Bad child')));

echo '<h3>Test 2: Ul + Div (invalid)</h3>';
if ($ul2->isValid()) {
    echo $ul2->render();
} else {
    echo 'Invalid';
}
report();

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
function report(?string $message = null)
{
    static $reports = [];

    if ($message === null) {
        echo '<pre>';
        print_r($reports);
        echo '</pre>';
        return $reports;
    } else {
        $reports[] = $message;
    }
}

report(); 
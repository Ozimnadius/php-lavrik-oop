<?php

namespace Sample2;

abstract class Node{
	abstract public function render();
	abstract public function isValid() : bool;

	protected function sanitize(string $inp) : string{
		return trim(htmlspecialchars($inp));
	}
}

abstract class Tag extends Node{
	abstract protected function name() : string;
	abstract protected function requiredAttrs() : array;
	abstract protected function allowedAttrs() : array;

	protected array $attrs = [];
	protected array $requiredAttrs = [];
	protected array $allowedAttrs = [];

	public function __construct()
	{
		foreach($this->requiredAttrs() as $name){
			$this->requiredAttrs[$name] = true;
		}

		foreach($this->allowedAttrs() as $name){
			$this->allowedAttrs[$name] = true;
		}
	}

	public function isValid(): bool
	{
		$isValid = true;
		$tagName = $this->name();

		foreach($this->requiredAttrs as $name => $value){
			if(!isset($this->attrs[$name])){
				report("$name is required attribute on $tagName");
				$isValid = false;
			}
		}

		foreach($this->attrs as $name => $value){
			if(!isset($this->allowedAttrs[$name]) && !isset($this->requiredAttrs[$name])){
				report("$name is not allowed on $tagName");
				$isValid = false;
			}
		}

		return $isValid;
	}

	public function attr(string $name, string $value){ // : static
		$this->attrs[$name] = $value;
		return $this;
	}

	protected function attrsToStr() : string{
		$str = '';

		foreach($this->attrs as $name => $value){
			$cleanedValue = $this->sanitize($value);
			$str .= " $name=\"$cleanedValue\"";
		}

		return trim($str);
	}
}

abstract class SingleTag extends Tag{
	public function render() : string{
		$attrs = $this->attrsToStr();
		$name = $this->name();
		return "<$name $attrs>";
	}
}

abstract class PairTag extends Tag{
	protected array $children = [];

	public function isValid(): bool
	{
		$isValid = parent::isValid();
		
		foreach($this->children as $child){
			$isValid = $child->isValid() && $isValid;
		}

		return $isValid;
	}

	public function appendChild(Node $child){
		$this->children[] = $child;
		return $this;
	}

	public function render() : string{
		$name = $this->name();
		$attrs = $this->attrsToStr();
		$childrenStr = implode('', array_map(fn(Node $child) => $child->render(), $this->children));
		return "<$name $attrs>$childrenStr</$name>";
	}
}

class TextNode extends Node{
	public function __construct(protected string $content)
	{
	}

	public function isValid() : bool{
		$isValid = trim($this->content) !== '';
		
		if(!$isValid){
			report('text node cant be empty');
		}

		return $isValid;
	}

	public function render() : string{
		return $this->sanitize($this->content);
	}
}

class Img extends SingleTag{
	protected function name() : string {
		return 'img';
	}

	protected function requiredAttrs() : array {
		return ['src', 'alt'];
	}

	protected function allowedAttrs() : array {
		return [];
	}
}

class Div extends PairTag{
	protected function name() : string {
		return 'div';
	}

	protected function requiredAttrs() : array {
		return [];
	}

	protected function allowedAttrs() : array {
		return [];
	}
}

/*$img = new Img('img');
$img->attr('src', '1.jpg')->attr('alt', 'n">z<h1>111</h1><img src="');
$h2 = (new PairTag('h2'))
	->appendChild(new TextNode('Hello, <h1>World!</h1>'))
	 ->appendChild(new TextNode(''))
	->appendChild(new TextNode('')) 
	;*/

$img = (new Img())->attr('src', '1.jpg')->attr('alt', 'n">z<h1>111</h1><img src="');
$div = new Div();
$div/* ->attr('src', '1.jpg') */->appendChild($img)/* ->appendChild($h2) */;

if($div->isValid()){
	echo $div->render();
}

/* <div>
&lt;div&gt;
 */

/* <div>
	<a href="url">path</a>
	<img src="" >
</div> */

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
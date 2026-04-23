<?php

namespace Sample3;

abstract class Node{
	abstract public function render();
}

abstract class Tag extends Node{
	protected array $attrs = [];

	public function __construct(protected string $name)
	{
		
	}

	public function attr(string $name, string $value){ // : static
		$this->attrs[$name] = $value;
		return $this;
	}

	protected function attrsToStr() : string{
		$str = '';

		foreach($this->attrs as $name => $value){
			$str .= " $name=\"$value\"";
		}

		return trim($str);
	}
}

class SingleTag extends Tag{
	public function render() : string{
		$attrs = $this->attrsToStr();
		return "<$this->name $attrs>";
	}
}

class PairTag extends Tag{
	protected array $children = [];

	public function appendChild(Node $child){
		$this->children[] = $child;
		return $this;
	}

	public function render() : string{
		$attrs = $this->attrsToStr();
		$childrenStr = implode('', array_map(fn(Node $child) => $child->render(), $this->children));
		return "<$this->name $attrs>$childrenStr</$this->name>";
	}
}

class TextNode extends Node{
	public function __construct(protected string $content)
	{
		
	}

	public function render() : string{
		return trim($this->content);
	}
}

$img = new SingleTag('img');
$img->attr('src', '1.jpg')->attr('alt', 'nz');

$h2 = (new PairTag('h2'))->appendChild(new TextNode('Hello, World!'));

$div = new PairTag('div');
echo $div->attr('class', 'some')->appendChild($img)->appendChild($h2)/* ->appendChild(new FlashNode()) */->render();
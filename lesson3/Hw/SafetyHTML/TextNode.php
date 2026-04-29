<?php

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
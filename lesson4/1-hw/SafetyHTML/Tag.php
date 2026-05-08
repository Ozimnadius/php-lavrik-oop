<?php

abstract class Tag extends Node{
	abstract protected function name() : string;

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

	protected function requiredAttrs() : array {
		return [];
	}
	
	protected function allowedAttrs() : array {
		return [];
	}
}
<?php

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
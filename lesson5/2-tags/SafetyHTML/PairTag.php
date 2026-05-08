<?php

namespace SafetyHTML;

abstract class PairTag extends Tag{
	protected array $children = [];

	abstract protected function allowedChilds() : array;
	
	public function isValid(): bool
	{
		$isValid = parent::isValid();
		
		foreach($this->children as $child){
			$allowed = false;

			foreach($this->allowedChilds() as $className){
				$allowed = ( $child instanceof $className );

				if($allowed){
					break;
				}
			}

			if(!$allowed){
				report($child::class . ' is not allowed child for ' . static::class);
			}

			$isValid = $allowed && $isValid;
		}

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
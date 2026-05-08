<?php

abstract class SingleTag extends Tag{
	public function render() : string{
		$attrs = $this->attrsToStr();
		$name = $this->name();
		return "<$name $attrs>";
	}
}
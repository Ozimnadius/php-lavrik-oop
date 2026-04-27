<?php

class Img extends SingleTag{
	protected function name() : string {
		return 'img';
	}

	protected function requiredAttrs() : array {
		return ['src', 'alt'];
	}
}
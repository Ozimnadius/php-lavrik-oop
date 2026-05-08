<?php

class Img extends SingleTag implements FlowContent, PalpableContent, PhrasingContent{
	protected function name() : string {
		return 'img';
	}

	protected function requiredAttrs() : array {
		return ['src', 'alt'];
	}
}
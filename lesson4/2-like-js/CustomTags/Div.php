<?php

class Div extends PairTag{
	protected function name() : string {
		return 'div';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, Img::class, A::class, Ul::class ];
	}
}
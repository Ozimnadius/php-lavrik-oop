<?php

class Div extends PairTag implements PalpableContent, FlowContent{
	protected function name() : string {
		return 'div';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, FlowContent::class ];
	}
}
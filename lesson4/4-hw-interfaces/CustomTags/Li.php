<?php

class Li extends PairTag{
	protected function name() : string {
		return 'li';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, FlowContent::class ];
	}
}
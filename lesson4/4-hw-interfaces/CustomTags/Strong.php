<?php

class Strong extends PairTag implements FlowContent, PalpableContent, PhrasingContent{
	protected function name() : string {
		return 'strong';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, PhrasingContent::class ];
	}
}
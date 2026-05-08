<?php

namespace CustomTags;

use SafetyHTML\FlowContent;
use SafetyHTML\PairTag;
use SafetyHTML\PalpableContent;
use SafetyHTML\TextNode;

class Div extends PairTag implements PalpableContent, FlowContent{
	protected function name() : string {
		return 'div';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, FlowContent::class ];
	}
}
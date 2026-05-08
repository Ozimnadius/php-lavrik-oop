<?php

namespace CustomTags;

use SafetyHTML\TextNode;
use SafetyHTML\PairTag;
use ContentGroups\FlowContent;
use ContentGroups\PalpableContent;

class Div extends PairTag implements PalpableContent, FlowContent{
	protected function name() : string {
		return 'div';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, FlowContent::class ];
	}
}
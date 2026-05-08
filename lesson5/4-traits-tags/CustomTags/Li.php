<?php

namespace CustomTags;

use ContentGroups\FlowContent;
use SafetyHTML\PairTag;
use SafetyHTML\TextNode;

class Li extends PairTag{
	protected function name() : string {
		return 'li';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, FlowContent::class ];
	}
}
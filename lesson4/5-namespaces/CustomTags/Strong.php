<?php

namespace CustomTags;

use SafetyHTML\FlowContent;
use SafetyHTML\PairTag;
use SafetyHTML\PalpableContent;
use SafetyHTML\PhrasingContent;
use SafetyHTML\TextNode;

class Strong extends PairTag implements FlowContent, PalpableContent, PhrasingContent{
	protected function name() : string {
		return 'strong';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, PhrasingContent::class ];
	}
}
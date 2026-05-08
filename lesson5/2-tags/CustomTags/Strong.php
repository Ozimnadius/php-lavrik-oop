<?php

namespace CustomTags;

use ContentGroups\FlowContent;
use SafetyHTML\PairTag;
use ContentGroups\PalpableContent;
use ContentGroups\PhrasingContent;
use SafetyHTML\TextNode;

class Strong extends PairTag implements FlowContent, PalpableContent, PhrasingContent{
	protected function name() : string {
		return 'strong';
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, PhrasingContent::class ];
	}
}
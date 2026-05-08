<?php

namespace CustomTags;

use SafetyHTML\PairTag;
use ContentGroups\PalpableContent;
use ContentGroups\FlowContent;
use ContentGroups\InteractiveContent;
use ContentGroups\PhrasingContent;
use SafetyHTML\TextNode;

class A extends PairTag implements PalpableContent, FlowContent, InteractiveContent, PhrasingContent {
	protected function name() : string {
		return 'a';
	}

	protected function requiredAttrs(): array
	{
		return ['href'];
	}

	protected function allowedChilds() : array {
		return [ TextNode::class, PalpableContent::class, FlowContent::class, PhrasingContent::class ];
	}
}
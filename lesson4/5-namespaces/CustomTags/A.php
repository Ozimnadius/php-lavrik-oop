<?php

namespace CustomTags;

use SafetyHTML\PairTag;
use SafetyHTML\PalpableContent;
use SafetyHTML\FlowContent;
use SafetyHTML\InteractiveContent;
use SafetyHTML\PhrasingContent;
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
<?php

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
<?php

namespace CustomTags;

use SafetyHTML\FlowContent;
use SafetyHTML\PairTag;
use SafetyHTML\PalpableContent;

class Ul extends PairTag implements FlowContent, PalpableContent{
	protected function name() : string {
		return 'ul';
	}

	protected function allowedChilds() : array {
		return [ Li::class ];
	}
}
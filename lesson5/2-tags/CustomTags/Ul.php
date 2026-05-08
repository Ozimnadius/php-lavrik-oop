<?php

namespace CustomTags;

use ContentGroups\FlowContent;
use SafetyHTML\PairTag;
use ContentGroups\PalpableContent;

class Ul extends PairTag implements FlowContent, PalpableContent{
	protected function name() : string {
		return 'ul';
	}

	protected function allowedChilds() : array {
		return [ Li::class ];
	}
}
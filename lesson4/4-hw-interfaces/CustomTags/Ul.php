<?php

class Ul extends PairTag implements FlowContent, PalpableContent{
	protected function name() : string {
		return 'ul';
	}

	protected function allowedChilds() : array {
		return [ Li::class ];
	}
}
<?php

class Ul extends PairTag{
	protected function name() : string {
		return 'ul';
	}

	protected function allowedChilds() : array {
		return [ Li::class ];
	}
}
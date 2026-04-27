<?php

class A extends PairTag{
	protected function name() : string {
		return 'a';
	}

	protected function requiredAttrs(): array
	{
		return ['href'];
	}
}
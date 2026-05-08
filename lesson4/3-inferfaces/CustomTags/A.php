<?php

class A extends PairTag implements Some1{
	protected function name() : string {
		return 'a';
	}

	protected function requiredAttrs(): array
	{
		return ['href'];
	}

	public function a(int $a) : string{
		return '';
	}
}
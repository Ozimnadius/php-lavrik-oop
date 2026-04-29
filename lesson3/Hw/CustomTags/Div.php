<?php

class Div extends PairTag{
	protected function name() : string {
		return 'div';
	}

    protected function allowedAttrs(): array
    {
        return ['class'];
    }
}
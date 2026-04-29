<?php

class P extends PairTag
{
    protected function name(): string
    {
        return 'p';
    }

    protected function allowedAttrs(): array
    {
        return ['class', 'id'];
    }
}
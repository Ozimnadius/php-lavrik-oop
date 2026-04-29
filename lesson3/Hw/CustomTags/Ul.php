<?php

class Ul extends PairTag
{
    protected function name(): string
    {
        return 'ul';
    }

    protected function allowedAttrs(): array
    {
        return ['class', 'id'];
    }

    protected function allowedChildren(): array
    {
        return [Li::class];
    }
}
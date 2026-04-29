<?php

abstract class PairTag extends Tag
{
    protected array $children = [];
    protected array $allowedChildren = [];


    public function __construct()
    {
        parent::__construct();

        $this->allowedChildren = $this->allowedChildren();
    }

    public function isValid(): bool
    {
        $isValid = parent::isValid();

        foreach ($this->children as $child) {
            $isValid = $child->isValid() && $isValid;

            if (!empty($this->allowedChildren) && !in_array($child::class, $this->allowedChildren)) {
                report($child::class . ' is not allowed inside ' . $this->name());
                $isValid = false;
            }
        }

        return $isValid;
    }

    public function appendChild(Node $child)
    {
        $this->children[] = $child;
        return $this;
    }

    public function render(): string
    {
        $name = $this->name();
        $attrs = $this->attrsToStr();
        $childrenStr = implode('', array_map(fn(Node $child) => $child->render(), $this->children));
        return "<$name $attrs>$childrenStr</$name>";
    }

    protected function allowedChildren(): array
    {
        return [];
    }
}
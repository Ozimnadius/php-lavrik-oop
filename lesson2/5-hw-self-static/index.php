<?php

namespace Sample5;

class Tag
{
    protected array $attrs = [];

    public function __construct(protected string $name)
    {

    }

    public function attr(string $name, string $value): static
    {
        $this->attrs[$name] = $value;
        return $this;
    }

    // abstract public function render() : string // it is better
    public function render(): string
    {
        return '';
    }

    protected function attrsToStr(): string
    {
        $str = '';

        foreach ($this->attrs as $name => $value) {
            $str .= " $name=\"$value\"";
        }

        return trim($str);
    }
}

class SingleTag extends Tag
{
    public function render(): string
    {
        $attrs = $this->attrsToStr();
        return "<$this->name $attrs>";
    }
}

class PairTag extends Tag
{
    protected array $children = [];

    public function appendChild(Tag $child): static
    {
        $this->children[] = $child;
        return $this;
    }

    public function render(): string
    {
        $attrs = $this->attrsToStr();
        $childrenStr = implode('', array_map(fn(Tag $child) => $child->render(), $this->children));
        return "<$this->name $attrs>$childrenStr</$this->name>";
    }
}

$img = new SingleTag('img');
$img->attr('src', '1.jpg')->attr('alt', 'nz');

$div = new PairTag('div');
echo $div->attr('class', 'some')->appendChild($img)->appendChild(new SingleTag('hr'))->render();
/* 
function forTest(): PairTag{
	return (new PairTag('form'))
        ->appendChild(
            (new PairTag('label'))
                ->appendChild((new SingleTag('img'))->attr('src', 'f1.jpg')->attr('alt', 'f1 not found'))
                ->appendChild((new SingleTag('input'))->attr('type', 'text')->attr('name', 'f1'))
        )
        ->appendChild(
            (new PairTag('label'))
                ->appendChild((new SingleTag('img'))->attr('src', 'f2.jpg')->attr('alt', 'f2 not found'))
                ->appendChild((new SingleTag('input'))->attr('type', 'password')->attr('name', 'f2'))
        )
        ->appendChild(
			  (new SingleTag('input'))->attr('type', 'submit')->attr('value', 'Send')
			);
} */
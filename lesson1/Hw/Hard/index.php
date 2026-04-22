<?php
declare(strict_types=1);

Namespace Hw\Hard;

abstract class Tag
{
    public function __construct(
        protected string $name,
        protected array  $attrs = [],
        protected array  $childrens = []
    )
    {
    }

    public function attr(string $name, string|null $value = null): static
    {
        $this->attrs[$name] = $value;
        return $this;
    }

    public function appendChild(Tag $tag): static
    {
        $this->childrens[] = $tag;
        return $this;
    }

    protected function renderAttrs(): string
    {
        $html = '';
        foreach ($this->attrs as $name => $value) {
            if ($value === null) {
                $html .= ' ' . $name;
                continue;
            }
            $html .= ' ' . $name . '="' . $value . '"';
        }
        return $html;
    }

    public function render(): string
    {
        return '<' . $this->name . $this->renderAttrs() . '/>';
    }
}

class SingleTag extends Tag
{

}

class PairTag extends Tag
{
    public function render(): string
    {
        $html = '<' . $this->name . $this->renderAttrs() . '>';

        foreach ($this->childrens as $child) {
            $html .= $child->render();
        }

        $html .= '</' . $this->name . '>';
        return $html;
    }
}


function forTest(): PairTag
{
    return new PairTag('form')
        ->appendChild(
            new PairTag('label')
                ->appendChild(
                    new SingleTag('img')
                        ->attr('src', 'f1.jpg')
                        ->attr('alt', 'f1 not found')
                )
                ->appendChild(
                    new SingleTag('input')
                        ->attr('type', 'text')
                        ->attr('name', 'f1')
                )
        )
        ->appendChild(
            new PairTag('label')
                ->appendChild(
                    new SingleTag('img')
                        ->attr('src', 'f2.jpg')
                        ->attr('alt', 'f2 not found')
                )
                ->appendChild(
                    new SingleTag('input')
                        ->attr('type', 'password')
                        ->attr('name', 'f2')
                )
        )
        ->appendChild(
            new SingleTag('input')
                ->attr('type', 'submit')
                ->attr('value', 'Send')
        );
}

$formHtml = forTest()->render();

echo $formHtml;

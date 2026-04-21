<?php
declare(strict_types=1);

class Tag
{
    public function __construct(
        protected string $name,
        public array     $attrs = [],
        public array     $childrens = []
    )
    {
    }

    public function attr(string $name, string $value = ''): void
    {
        $this->attrs[$name] = $value;
    }

    public function appendChild(Tag $tag): void
    {
        $this->childrens[] = $tag;
    }

    protected function renderAttrs(): string
    {
        $html = '';
        foreach ($this->attrs as $name => $value) {
            if ($value === '') {
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


$form = new PairTag('form');
$form->attr('action', '/');
$form->attr('method', 'post');

$label = new PairTag('label');

$img = new SingleTag('img');
$img->attr('src', 'f1.jpg');
$img->attr('alt', 'f1.jpg');
$img->attr('not found');

$input = new SingleTag('input');
$input->attr('type', 'text');
$input->attr('name', 'f1');

$label->appendChild($img);
$label->appendChild($input);

$form->appendChild($label);

$label = new PairTag('label');
$img = new SingleTag('img');
$img->attr('src', 'f2.jpg');
$img->attr('alt', 'f2.jpg');
$img->attr('not found');

$input = new SingleTag('input');
$input->attr('type', 'text');
$input->attr('name', 'f2');

$label->appendChild($img);
$label->appendChild($input);

$form->appendChild($label);

$input = new SingleTag('input');
$input->attr('type', 'submit');
$input->attr('value', 'Send');

$form->appendChild($input);

$formHtml = $form->render();

echo $formHtml;

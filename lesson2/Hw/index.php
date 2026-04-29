<?php

namespace Hw2;

abstract class Node
{
    /**
     * @return mixed
     */
    abstract public function render(): string;

    /**
     * @return bool
     */
    abstract public function isValid(): bool;

    /**
     * @param string $inp
     * @return string
     */
    protected function sanitize(string $inp): string
    {
        return trim(htmlspecialchars($inp));
    }
}

abstract class Tag extends Node
{
    protected array $attrs = [];
    protected array $requiredAttrs = [];
    protected array $allowedAttrs = ['title' => true];

    /**
     * @param string $name
     */
    public function __construct(protected string $name)
    {

    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $isValid = true;

        foreach ($this->requiredAttrs as $name => $value) {
            if (!isset($this->attrs[$name])) {
                report("$name is required attribute on $this->name");
                $isValid = false;
            }
        }

        foreach ($this->attrs as $name => $value) {
            if (!isset($this->allowedAttrs[$name]) && !isset($this->requiredAttrs[$name])) {
                report("$name is not allowed on $this->name");
                $isValid = false;
            }
        }

        return $isValid;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function attr(string $name, string $value): static
    {
        $this->attrs[$name] = $value;
        return $this;
    }

    /**
     * @return string
     */
    protected function attrsToStr(): string
    {
        $str = '';

        foreach ($this->attrs as $name => $value) {
            $cleanedValue = $this->sanitize($value);
            $str .= " $name=\"$cleanedValue\"";
        }

        return trim($str);
    }
}

abstract class SingleTag extends Tag
{
    /**
     * @return string
     */
    public function render(): string
    {
        $attrs = $this->attrsToStr();
        return "<$this->name $attrs>";
    }
}

class PairTag extends Tag
{
    protected array $children = [];

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $isValid = parent::isValid();

        foreach ($this->children as $child) {
            $isValid = $child->isValid() && $isValid;
        }

        return $isValid;
    }

    /**
     * @param Node $child
     * @return $this
     */
    public function appendChild(Node $child): static
    {
        $this->children[] = $child;
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $attrs = $this->attrsToStr();
        $childrenStr = implode('', array_map(fn(Node $child) => $child->render(), $this->children));
        return "<$this->name $attrs>$childrenStr</$this->name>";
    }
}

class TextNode extends Node
{
    /**
     * @param string $content
     */
    public function __construct(protected string $content)
    {
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $isValid = trim($this->content) !== '';

        if (!$isValid) {
            report('text node cant be empty');
        }

        return $isValid;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->sanitize($this->content);
    }
}

class Img extends SingleTag
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct('img');
        $this->requiredAttrs['src'] = true;
        $this->requiredAttrs['alt'] = true;
    }
}

class Div extends PairTag
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct('div');
    }
}

$img = new Img();
$img->attr('src', '1.jpg')->attr('alt', 'n">z<h1>111</h1><img src="');
$h2 = new PairTag('h2')->appendChild(new TextNode('Hello, <h1>World!</h1>'))
    ->appendChild(new TextNode(''))
    ->appendChild(new TextNode(''));
if ($h2->isValid()) {
    echo $h2->render();
}

$img = new Img()->attr('src', '1.jpg')->attr('alt', 'n">z<h1>111</h1><img src="');
$div = new Div();
$div->appendChild($img)/* ->appendChild($h2) */
;

if ($div->isValid()) {
    echo $div->render();
}

/* <div>
&lt;div&gt;
 */

/* <div>
	<a href="url">path</a>
	<img src="" >
</div> */

function report(?string $message = null)
{
    static $reports = [];

    if ($message === null) {
        echo '<pre>';
        print_r($reports);
        echo '</pre>';
        return $reports;
    } else {
        $reports[] = $message;
    }
}

report();
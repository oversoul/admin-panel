<?php

namespace Aecodes\AdminPanel\Layouts;

use Aecodes\AdminPanel\View;
use Aecodes\AdminPanel\Helper;

class Div
{

    /**
     * Children of div
     *
     * @var array
     */
    protected $items = [];

    /**
     * Div attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Create a new Div
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Create new Div statically
     *
     * @param array $items
     * @return self
     */
    public static function make(array $items): self
    {
        return new static($items);
    }

    /**
     * Magic method to set attributes.
     *
     * @param string $key
     * @param array $params
     * @return self
     */
    final public function __call(string $key, array $params = []): self
    {
        $this->attributes[$key] = $params[0];
        return $this;
    }

    /**
     * Render TD
     *
     * @param mixed $source
     * @param View $view
     * @return string
     */
    public function build($source, View $view): string
    {
        $parts = [];

        foreach ($this->items as $item) {
            $parts[] = is_string($item) ? $item : $item->build($source, $view);
        }

        $content = \implode("\n", $parts);
        $attributes = Helper::attributes($this->attributes);

        return \sprintf("<div %s>%s</div>", $attributes, $content);
    }
}

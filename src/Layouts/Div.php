<?php

namespace Aecodes\AdminPanel\Layouts;

use Aecodes\AdminPanel\Panel;
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
     * @param string
     * @param array
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
     * @param mixed
     * @return string
     */
    public function build($source, ?Panel $panel = null): string
    {
        $parts = [];

        foreach ($this->items as $item) {
            $parts[] = is_string($item) ? $item : $item->build($source, $panel);
        }

        $content = \implode("\n", $parts);
        $attributes = Helper::attributes($this->attributes);

        return \sprintf("<div %s>%s</div>", $attributes, $content);
    }
}

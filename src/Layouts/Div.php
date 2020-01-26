<?php

namespace Aecodes\AdminPanel\Layouts;

use Aecodes\AdminPanel\Panel;

class Div
{

    protected $items = [];
    protected $attributes = [];

    /**
     * Create a new Div
     *
     * @param string $title
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
     * Turns the attributes to string.
     *
     * @return string
     */
    protected function attributes(): string
    {
        $attrs = [];
        foreach ($this->attributes as $key => $value) {
            $attrs[] = "{$key}=\"{$value}\"";
        }

        return \implode(' ', $attrs);
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

        return \sprintf("<div %s>%s</div>", $this->attributes(), $content);
    }
}

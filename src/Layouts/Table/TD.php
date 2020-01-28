<?php

namespace Aecodes\AdminPanel\Layouts\Table;

class TD
{

    /**
     * Source field key
     *
     * @var string
     */
    protected $name;

    /**
     * Column title
     *
     * @var string
     */
    protected $title;

    /**
     * Custom renderer
     *
     * @var null|callback
     */
    protected $renderer = null;

    /**
     * Create a new TD
     *
     * @param string $name
     * @param string $title
     */
    public function __construct(string $name, string $title)
    {
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * Create new TD statically
     *
     * @param string $name
     * @param string $title
     * @return self
     */
    public static function make(string $name, string $title): self
    {
        return new static($name, $title);
    }

    /**
     * Set custom renderer.
     *
     * @param callback
     * @return self
     */
    public function render(callable $callback): self
    {
        $this->renderer = $callback;
        return $this;
    }

    /**
     * Render th
     *
     * @return string
     */
    public function renderTitle(): string
    {
        return \sprintf('<th>%s</th>', $this->title);
    }

    /**
     * Get value
     *
     * @param $row
     * @return mixed
     */
    protected function getValue($row)
    {
        if ($this->renderer == null) {
            return $row->{$this->name};
        }

        $data = \call_user_func($this->renderer, $row);

        if (\is_string($data)) {
            return $data;
        }

        if (!\is_array($data)) {
            return $data->build($row);
        }

        $result = [];
        foreach ($data as $element) {
            $result[] = is_string($element) ? $element : $element->build();
        }
        
        return \implode("", $result);
    }

    /**
     * Render TD
     *
     * @param mixed
     * @return string
     */
    public function renderValue($row): string
    {
        $data = $this->getValue($row);
        return \sprintf("<td>%s</td>", $data);
    }
}
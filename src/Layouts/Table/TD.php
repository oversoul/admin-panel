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
     * @var callback
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
     * @param callable $callback
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
        return $this->title;
    }

    /**
     * If Renderer is defined use it.
     *
     * @param mixed $row
     * @return mixed
     */
    protected function getRendererOutput($row)
    {
        if ($this->renderer == null) {
            return $row;
        }

        $data = \call_user_func($this->renderer, $row);

        if (!is_array($data)) {
            return $data;
        }

        $result = [];

        foreach ($data as $element) {
            $result[] = is_string($element) ? $element : $element->build();
        }

        return \implode("", $result);
    }

    /**
     * Get value
     *
     * @param $row
     * @return mixed
     */
    protected function getValue($row)
    {
        $data = $this->getRendererOutput($row);

        if (\is_string($data) || \is_numeric($data)) {
            return $data;
        }

        if (\is_object($data)) {
            return $data->{$this->name};
        }

        return $data[$this->name];
    }

    /**
     * Render TD
     *
     * @param mixed $row
     * @return string
     */
    public function renderValue($row): string
    {
        return $this->getValue($row);
    }
}

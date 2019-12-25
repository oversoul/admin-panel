<?php

namespace Aecodes\AdminPanel\Actions;

class Action
{

    /**
     * Action value
     *
     * @var string
     */
    protected $value;

    /**
     * Html attributes
     *
     * @param array
     */
    protected $attributes = [];

    /**
     * Create new Action
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Create new Action staticly
     *
     * @param string $value
     * @return self
     */
    public static function make(string $value): self
    {
        return new static($value);
    }

    /**
     * Turns the attributes to string.
     *
     * @return string
     */
    final protected function attributes(): string
    {
        $attrs = [];
        foreach ($this->attributes as $key => $value) {
            $attrs[] = "{$key}=\"{$value}\"";
        }

        return \implode(' ', $attrs);
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
     * Default build method incase its not defined.
     *
     * @return string
     */
    public function build(): string
    {
        return '';
    }

    /**
     * Magic method to build field
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->build();
    }

    /**
     * Magic method to call button and link on Action
     *
     * @param string $method
     * @param array $params
     * @return Button|Link
     */
    public static function __callStatic(string $method, array $params = [])
    {
        if (\in_array($method, ['button', 'link'])) {
            $method = 'Aecodes\AdminPanel\Actions\\' . ucfirst($method);
            return \call_user_func_array([$method, 'make'], $params);
        }
    }
}

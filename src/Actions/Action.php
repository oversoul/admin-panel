<?php

namespace Aecodes\AdminPanel\Actions;
use Exception;

class Action
{

    /**
     * Is action a delete?
     *
     * @var boolean
     */
    protected $delete = false;

    /**
     * Action value
     *
     * @var string
     */
    protected $value;

    /**
     * Html attributes
     *
     * @var array
     * FIXME: this redendant in both actions
     */
    protected $attributes = [];

    /**
     * Allowed actions.
     * @var array
     */
    protected static $allowedActions = [
        'button' => Button::class,
        'delete' => Link::class,
        'link'   => Link::class,
    ];

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
     * Set action as delete
     *
     * @return self
     */
    protected function setDelete(): self
    {
        $this->delete = true;
        return $this;
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
     * @return Button|Link|void
     * @throws Exception
     */
    public static function __callStatic(string $method, array $params = [])
    {
        if (isset(static::$allowedActions[$method])) {
            $className = static::$allowedActions[$method];
            $object    = call_user_func_array([$className, 'make'], $params);

            if ($method === 'delete') {
                return $object->setDelete();
            }

            return $object;
        }

        throw new Exception("{$method} is an invalid action type.");
    }
}

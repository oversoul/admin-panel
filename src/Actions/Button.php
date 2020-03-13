<?php

namespace Aecodes\AdminPanel\Actions;

use Exception;

class Button extends Action
{

    /**
     * Button type
     *
     * @var string
     */
    protected $type = 'submit';

    /**
     * Button attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Set button type
     *
     * @param string $type
     * @return self
     */
    public function type(string $type): self
    {
        if (!in_array($type, ['submit', 'reset'])) {
            throw new Exception("Button type Should be either 'submit' or 'reset'");
        }
        $this->type = $type;
        return $this;
    }

    /**
     * Build button
     *
     * @return string
     */
    public function build(): string
    {
        return \sprintf(
            '<button type="%s" %s>%s</button>',
            $this->type,
            $this->buildAttributes(),
            $this->value
        );
    }
}

<?php

namespace Aecodes\AdminPanel\Widgets\Actions;

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
	 * @throws Exception
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
	 * @param array $data
	 * @return array
	 */
    public function build(array $data): array
    {
        $attributes = array_merge(
            $this->buildAttributes(), 
            ['type' => $this->type]
        );

        return [
            'type'       =>  'Button',
            'value'      =>  $this->value,
            'attributes' =>  $attributes,
        ];
    }
}

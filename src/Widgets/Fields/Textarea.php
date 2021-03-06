<?php

namespace Aecodes\AdminPanel\Widgets\Fields;

class Textarea extends Field
{

    /**
     * Field attributes
     *
     * @var array
     */
    protected $attributes = [
        'rows' => '3',
    ];

    /**
     * Build textarea
     *
     * @param array $data
     * @return array
     */
    public function build(array $data): array
    {
        $this->getValue($data);

        $attributes = array_merge($this->getAttributes(), [
            'name' => $this->name,
        ]);

        return [
            'type'       => 'Textarea',
            'title'      => $this->title,
            'value'      => $this->value,
            'attributes' => $attributes
        ];
    }
}

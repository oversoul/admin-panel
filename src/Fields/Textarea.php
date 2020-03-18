<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\View;

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
     * @return string
     */
    public function build(array $data, View $view): string
    {
        $this->getValue($data);

        return $view->partial('fields/textarea', [
            'name' => $this->name,
            'title' => $this->title,
            'value' => $this->value,
            'attributes' => $this->getAttributes(),
        ]);
    }
}

<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Layouts\View;

class TextArea extends Field
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
        $attributes = Helper::attributes($this->attributes);

        return $view->partial('fields/textarea', [
            'name' => $this->name,
            'title' => $this->title,
            'value' => $this->value($data),
            'attributes' => $attributes,
        ]);
    }
}

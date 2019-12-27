<?php

namespace Aecodes\AdminPanel\Fields;

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
    public function build(array $data): string
    {
        return $this->render('textarea', [
            ':name' => $this->name,
            ':title' => $this->title,
            ':value' => $this->value($data),
            ':attributes' => $this->attributes(),
        ]);
    }
}

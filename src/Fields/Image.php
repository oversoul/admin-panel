<?php

namespace Aecodes\AdminPanel\Fields;

class Image extends Field
{

    protected $multiple = false;
    protected $help = 'Upload files here and they won\'t be sent immediately';

    public function multiple(): self
    {
        $this->multiple = true;
        return $this;
    }

    public function build(array $data): string
    {
        return $this->render('image', [
            '[name]' => $this->name,
            '[help]' => $this->help,
            '[title]' => $this->title,
            '[value]' => $this->value($data),
            '[attributes]' => $this->attributes(),
            '[multiple]' => $this->multiple ? 'multiple' : '',
        ]);
    }
}

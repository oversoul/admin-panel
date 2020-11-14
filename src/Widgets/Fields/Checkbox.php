<?php

namespace Aecodes\AdminPanel\Widgets\Fields;

class Checkbox extends Input
{

    protected $type = 'checkbox';

    protected function getAttributes(): array
    {
        $this->attributes = ['checked' => $this->value];
        return parent::getAttributes();
    }
}

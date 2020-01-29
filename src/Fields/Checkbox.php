<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\Layouts\View;

class Checkbox extends Field
{

    /**
     * Build input field
     *
     * @param array $data
     * @return string
     */
    public function build(array $data, View $view): string
    {
        return $view->partial('fields/checkbox', [
            'name' => $this->name,
            'title' => $this->title,
            'value' => $this->value($data) ? ' checked' : '',
        ]);
    }
}

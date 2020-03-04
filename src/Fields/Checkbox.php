<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\View;

class Checkbox extends Field
{

    /**
     * Build input field
     *
     * @param array $data
     * @param View $view
     * @return string
     */
    public function build(array $data, View $view): string
    {
        return $view->partial('fields/checkbox', [
            'name' => $this->name,
            'title' => $this->title,
            'value' => $this->getValue($data) ? ' checked' : '',
        ]);
    }
}

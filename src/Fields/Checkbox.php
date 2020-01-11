<?php

namespace Aecodes\AdminPanel\Fields;

class Checkbox extends Field
{

    /**
     * Build input field
     *
     * @param array $data
     * @return string
     */
    public function build(array $data): string
    {
        return $this->render('checkbox', [
            '[name]' => $this->name,
            '[title]' => $this->title,
            '[value]' => $this->value($data) === '1' ? ' checked' : '',
            // $this->attributes(),
        ]);
    }
}

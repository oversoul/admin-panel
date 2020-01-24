<?php

namespace Aecodes\AdminPanel\Fields;

class Input extends Field
{

    /**
     * Input type
     *
     * @var string
     */
    protected $type = 'text';

    /**
     * Set the input type
     *
     * @param string $type
     * @return self
     */
    public function type(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Build input field
     *
     * @param array $data
     * @return string
     */
    public function build(array $data): string
    {
        return $this->render('input', [
            'type' => $this->type,
            'help' => $this->help,
            'name' => $this->name,
            'title' => $this->title,
            'value' => $this->value($data),
            'attributes' => $this->attributes(),
        ]);
    }
}

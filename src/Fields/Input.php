<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Layouts\View;

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

    public static function __callStatic($method, array $params = [])
    {
        $target = $params[0];
        return self::make($target)->type($method);
    }

    /**
     * Build input field
     *
     * @param array $data
     * @return string
     */
    public function build(array $data, View $view): string
    {
        $attributes = Helper::attributes($this->attributes);
        
        return $view->partial('fields/input', [
            'type' => $this->type,
            'help' => $this->help,
            'name' => $this->name,
            'title' => $this->title,
            'value' => $this->value($data),
            'attributes' => $attributes,
        ]);
    }
}

<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Layouts\View;

class Image extends Field
{

    protected $path = '';
    protected $multiple = false;
    protected $help = 'Upload files here and they won\'t be sent immediately';

    public function multiple(): self
    {
        $this->multiple = true;
        return $this;
    }

    public function path($path): self
    {
        $this->path = $path;
        return $this;
    }

    public function build(array $data, View $view): string
    {
        $attributes = Helper::attributes($this->attributes);
        
        return $view->partial('fields/image', [
            'name' => $this->name,
            'help' => $this->help,
            'path' => $this->path,
            'title' => $this->title,
            'value' => $this->value($data),
            'attributes' => $attributes,
            'multiple' => $this->multiple ? 'multiple' : '',
        ]);
    }
}

<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\View;

class Image extends Field
{

    /**
     * Image path
     *
     * @var string
     */
    protected $path = '';

    /**
     * Uploading multiple images?
     *
     * @var boolean
     */
    protected $multiple = false;

    /**
     * Helper text
     *
     * @var string
     */
    protected $help = "Upload files here and they won't be sent immediately";

    /**
     * Enabling multiple files
     *
     * @return self
     */
    public function multiple(): self
    {
        $this->multiple = true;
        return $this;
    }

    /**
     * Setting the path
     *
     * @param string $path
     * @return self
     */
    public function path(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Build image upload field
     *
     * @param array $data
     * @param View $view
     * @return string
     */
    public function build(array $data, View $view): string
    {
        $this->getValue($data);

        return $view->partial('fields/image', [
            'name'       => $this->name,
            'help'       => $this->help,
            'path'       => $this->path,
            'title'      => $this->title,
            'value'      => $this->value,
            'attributes' => $this->getAttributes(),
            'multiple'   => ($this->multiple === true) ? 'multiple' : '',
        ]);
    }
}

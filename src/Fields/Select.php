<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\View;
use Aecodes\AdminPanel\Helper;

class Select extends Field
{

    /**
     * Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Show when empty
     *
     * @var string
     */
    protected $empty = null;
    
    /**
     * Multiple choices
     *
     * @var boolean
     */
    protected $multiple = false;

    /**
     * Default attributes
     * autocomplete = off is set for firefox weird behavior
     *
     * @var array
     */
    protected $attributes = [
        'autocomplete' => 'off',
    ];

    /**
     * Set options
     *
     * @param array $options
     * @return self
     */
    public function options(array $options = []): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Enable multiple choices
     *
     * @return self
     */
    public function multiple(): self
    {
        $this->multiple = true;
        return $this;
    }

    /**
     * Set empty option
     *
     * @param string $value
     * @return self
     */
    public function empty(string $value): self
    {
        $this->empty = $value;
        return $this;
    }

    /**
     * Convert options array to html options.
     *
     * @param mixed $data
     * @return string
     */
    protected function buildOptions($data): string
    {
        $options = [];
        $selected = $this->value($data);

        // dd($selected);

        if ( $this->empty ) {
            $options[] = \sprintf(
                '<option value="-1" hidden>%s</option>',
                $this->empty
            );
        }

        foreach ($this->options as $key => $value) {
            $isSelected = \is_array($selected) ? in_array($key, $selected) : $key === $selected;

            $options[] = \sprintf(
                '<option value="%s"%s>%s</option>',
                $key,
                ($isSelected) ? ' selected' : '',
                $value,
            );
        }

        return \implode("\n", $options);
    }

    /**
     * Build input field
     *
     * @param array $data
     * @return string
     */
    public function build(array $data, View $view): string
    {
        $options = $this->buildOptions($data);

        if ($this->multiple === true) {
            $this->name .= '[]';
            $this->attributes['multiple'] = '';
        }

        $attributes = Helper::attributes($this->attributes);

        return $view->partial('fields/select', [
            'name' => $this->name,
            'title' => $this->title,
            'options' => $options,
            'attributes' => $attributes,
        ]);
    }
}

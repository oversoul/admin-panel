<?php

namespace Aecodes\AdminPanel\Widgets\Fields;

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
    public function options($options = []): self
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
    function empty(string $value): self
    {
        $this->empty = $value;
        return $this;
    }

    /**
     * Convert options array to html options.
     *
     * @return array
     */
    protected function buildOptions(): array
    {
        $options = [];

        if ($this->empty) {
            $options[] = [
                'value'  => -1,
                'hidden' => true,
                'text'   => $this->empty,
            ];
        }

        foreach ($this->options as $key => $value) {
            $isSelected = \is_array($this->value) ? in_array($key, $this->value) : $key === $this->value;

            $options[] = [
                'value'    => $key,
                'text'     => $value,
                'selected' => $isSelected,
            ];
        }

        return $options;
    }

    /**
     * Build input field
     *
     * @param array $data
     * @return array
     */
    public function build(array $data): array
    {
        $this->getValue($data);

        $options = ($this->multiple === true) ? $this->options : $this->buildOptions();

        $attributes = array_merge($this->getAttributes(), [
            'name'     => $this->name,
            'multiple' => $this->multiple,
        ]);

        return [
            'type'       => 'fields/select', 
            'title'      => $this->title,
            'help'       => $this->help,
            'attributes' => $attributes,
            'options'    => $options,
        ];
    }
}

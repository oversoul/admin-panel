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
     * @var mixed
     */
    protected $emptyValue = -1;

    /**
     * Multiple choices
     *
     * @var boolean
     */
    protected $multiple = false;

    /**
     * Allows to use options for both key and val
     * @var bool
     */
    protected $useValues = false;

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
     * Create new instance and set useValues.
     *
     * @param string $target
     * @return self
     */
    public static function values(string $target): self
    {
        return (new Select($target))->useValues();
    }

    /**
     * @return $this
     */
    public function useValues(): self
    {
        $this->useValues = true;
        return $this;
    }

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
     * @param string $label
     * @param mixed $value
     * @return self
     */
    function empty(string $label, $value = -1): self
    {
        $this->empty = $label;
        $this->emptyValue = $value;
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
                'hidden' => true,
                'text'   => $this->empty,
                'value'  => $this->emptyValue,
            ];
        }

        foreach ($this->options as $key => $value) {
            $key = $this->useValues ? $value : $key;
            $isSelected = is_array($this->value) ? in_array($key, $this->value) : $key === $this->value;

            $options[] = ['value' => $key, 'text' => $value, 'selected' => $isSelected];
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
            'name' => $this->name,
        ]);

        return [
            'type'       => 'Select',
            'title'      => $this->title,
            'help'       => $this->help,
            'attributes' => $attributes,
            'options'    => $options,
            'multiple'   => $this->multiple,
        ];
    }
}

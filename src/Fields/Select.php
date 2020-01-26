<?php

namespace Aecodes\AdminPanel\Fields;

class Select extends Field
{

    protected $options = [];
    protected $multiple = false;
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

    public function multiple()
    {
        $this->multiple = true;
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

        foreach ($this->options as $key => $value) {
            $isSelected = \is_array($selected) ? in_array($key, $selected) : $key === $selected;

            $options[] = \sprintf(
                '<option value="%s" %s>%s</option>',
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
    public function build(array $data): string
    {
        $options = $this->buildOptions($data);

        if ($this->multiple === true) {
            $this->name .= '[]';
            $this->attributes['multiple'] = '';
        }

        return $this->render('select', [
            'name' => $this->name,
            'title' => $this->title,
            'options' => $options,
            'attributes' => $this->attributes(),
        ]);
    }
}

<?php

namespace Aecodes\AdminPanel\Fields;

class Select extends Field
{

    protected $options = [];
    protected $attributes = [
        'class' => 'form-control',
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
            $options[] = \sprintf(
                '<option value="%s" %s>%s</option>',
                $key,
                ($key == $selected) ? ' selected' : '',
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

        return \sprintf(
            '<div class="form-group">
                <label class="form-control-label" for="%s">%s</label>
                <select name="%s" %s>
                    %s
                </select>
            </div>',
            $this->target,
            $this->title,
            $this->name,
            $this->attributes(),
            $options,
        );
    }
}

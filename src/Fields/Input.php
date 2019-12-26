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
        return \sprintf(
            '<div class="form-group">
                <label class="form-control-label" for="%s">%s</label>
                <input type="%s" id="%s" value="%s" name="%s" %s>
                <span class="help-block">%s</span>
            </div>',
            $this->target,
            $this->title,
            $this->type,
            $this->target,
            $this->value($data),
            $this->name,
            $this->attributes(),
            $this->help,
        );
    }
}

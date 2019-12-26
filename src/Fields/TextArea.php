<?php

namespace Aecodes\AdminPanel\Fields;

class TextArea extends Field
{

    /**
     * Field attributes
     *
     * @var array
     */
    protected $attributes = [
        'class' =>  'form-control',
        'rows'  =>  '3'
    ];

    /**
     * Build textarea
     *
     * @param array $data
     * @return string
     */
    public function build(array $data): string
    {
        return \sprintf(
            '<div class="form-group">
                <label class="form-control-label" for="textarea">%s</label>
                <textarea name="%s" %s>%s</textarea>
            </div>',
            $this->title,
            $this->name,
            $this->attributes(), 
            $this->value($data),
        );
    }
}

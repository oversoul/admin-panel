<?php

namespace Aecodes\AdminPanel\Fields;

class Checkbox extends Field
{

    protected $attributes = [


    ];


    /**
     * Build input field
     *
     * @param array $data
     * @return string
     */
    public function build(array $data): string
    {

        return \sprintf(
            '<div class="form-check">
                <label class="form-check-label">
                    <input type="hidden" name="%s" value="0" />
                    <input class="form-check-input"%s type="checkbox" name="%s" value="1">
                    %s
                </label>
            </div>',
            $this->name,
    
            $this->value($data) === '1' ? ' checked' : '',
            
            $this->name,
            $this->title,
            // $this->attributes(),
        );
    }
}

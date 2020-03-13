<?php

namespace Aecodes\AdminPanel\Actions;

class Link extends Action
{

    /**
     * Href
     *
     * @var string
     */
    protected $href = '';

    /**
     * Set href for link
     *
     * @param string $link
     * @return self
     */
    public function href(string $link): self
    {
        $this->href = $link;
        return $this;
    }

    /**
     * Set href for link
     *
     * @param string $link
     * @return self
     */
    public function url(string $link): self
    {
        return $this->href($link);
    }

    /**
     * Build link
     *
     * @return string
     */
    public function build(): string
    {
        if ($this->delete === true) {
            $this->attributes['onclick'] = 'triggerDestroyForm(event, \'' . $this->href . '\')';
            $this->href                  = 'javascript:{}';
        }

        $attributes = $this->buildAttributes();

        return \sprintf(
            '<a href="%s" %s>%s</a>',
            $this->href,
            $attributes,
            $this->value
        );
    }
}

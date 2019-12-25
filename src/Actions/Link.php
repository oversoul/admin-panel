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
     * Build link
     *
     * @return string
     */
    public function build(): string
    {
        return \sprintf(
            '<a href="%s" %s>%s</a>',
            $this->href,
            $this->attributes(),
            $this->value,
        );
    }
}

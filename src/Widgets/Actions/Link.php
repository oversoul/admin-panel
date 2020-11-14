<?php

namespace Aecodes\AdminPanel\Widgets\Actions;

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
	 * @param array $data
	 * @return array
	 */
    public function build(array $data): array
    {
        if ($this->delete === true) {
            $this->attributes['onclick'] = 'triggerDestroyForm(event, \'' . $this->href . '\')';
            $this->href                  = 'javascript:{}';
        }

        $attributes = array_merge(
            $this->buildAttributes(), 
            ['href'   =>  $this->href]
        );

        return [
            'type'       =>  'Link',
            'value'      =>  $this->value,
            'attributes' =>  $attributes,
        ];
    }
}

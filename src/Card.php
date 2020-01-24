<?php

namespace Aecodes\AdminPanel;

class Card
{

    /**
     * Card classes
     *
     * @var string
     */
    protected $class = '';

    /**
     * Title of the card
     *
     * @var string
     */
    protected $title;

    /**
     * Content of the card
     *
     * @var string
     */
    protected $content;

    /**
     * Content of the card
     *
     * @var string
     */
    protected $icon = '';

    /**
     * Undocumented function
     *
     * @param string $title
     * @param string $content
     */
    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Set icon for card
     *
     * @param string $icon
     * @return self
     */
    public function icon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Create form instance statically
     *
     * @param sting $title
     * @param sting $content
     * @return self
     */
    public static function make(string $title, string $content): self
    {
        return new static($title, $content);
    }

    /**
     * Set card classes
     *
     * @param string $className
     * @return self
     */
    function class (string $className): self
    {
        $this->class = $className;
        return $this;
    }

    /**
     * Build form
     *
     * @param mixed $source
     * @return string
     */
    public function build($source, Panel $page): string
    {
        return View::make('card', [
            'icon' => $this->icon,
            'title' => $this->title,
            'class' => $this->class,
            'content' => $this->content,
        ])->build($source, $page);
    }
}

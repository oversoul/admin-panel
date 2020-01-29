<?php

namespace Aecodes\AdminPanel\Layouts;

use Aecodes\AdminPanel\Panel;
use Aecodes\AdminPanel\Accessor;
use Aecodes\AdminPanel\Layouts\View;

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

    protected $attributes = [];

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
     * Magic method to set attributes
     *
     * @param string $key
     * @param array $params
     * @return self
     */
    public function __call(string $key, array $params = []): self
    {
        if (!in_array($key, ['class', 'title', 'content'])) {
            $this->attributes[$key] = $params[0];
        }

        return $this;
    }

    /**
     * Build form
     *
     * @param mixed $source
     * @return string
     */
    public function build($source, View $view)
    {
        $data = array_merge([
            'title' => $this->title,
            'class' => $this->class,
            'content' => $this->content,
        ], $this->attributes);

        return $view->partial('card', ['card' => new Accessor($data)]);
    }
}

<?php

namespace Aecodes\AdminPanel;

class Card
{

    /**
     * Form width
     *
     * @var integer
     */
    protected $size = 100;

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
     * Allowed sizes
     *
     * @var array
     */
    protected $allowedSizes = [25, 50, 75, 100];

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
     * Set form size
     *
     * @param integer $percent
     * @return self
     */
    public function size(int $percent): self
    {
        if (!in_array($percent, $this->allowedSizes)) {
            $percent = 100;
        }

        $this->size = $percent;
        return $this;
    }

    protected function getColumnSize(): string
    {
        switch ($this->size) {
            case 25:
                return 'col-3';
            case 50:
                return 'col-6';
            case 75:
                return 'col-9';
            default:
                return 'col-12';
        }
    }

    /**
     * Build form
     *
     * @param mixed $source
     * @return string
     */
    public function build($source): string
    {
        $icon = $this->icon;
        $title = $this->title;
        $content = $this->content;
        $size = $this->getColumnSize();

        ob_start();
        require dirname(__FILE__) . "/presenters/card.php";
        return ob_get_clean();
    }
}

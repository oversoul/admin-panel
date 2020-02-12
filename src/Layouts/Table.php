<?php

namespace Aecodes\AdminPanel\Layouts;

use Exception;
use Aecodes\AdminPanel\View;
use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Accessor;

class Table
{

    /**
     * Data target (key)
     *
     * @var string
     */
    protected $target;

    /**
     * Table Colums
     *
     * @var array
     */
    protected $columns = [];

    /**
     * Table footer
     *
     * @var array
     */
    protected $footer = [];

    /**
     * Create new Table
     *
     * @param array $columns
     * @param string|null $target
     */
    public function __construct(array $columns, ?string $target = null)
    {
        if (empty($columns)) {
            throw new Exception("No columns defined for the table.");
        }

        $this->target = $target;
        $this->columns = $columns;
    }

    /**
     * Set table target - data key
     *
     * @param string $target
     * @return self
     */
    public function target(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Set table footer (pagination?)
     *
     * @param array $elements
     * @return self
     */
    public function footer(array $elements): self
    {
        $this->footer = $elements;
        return $this;
    }

    /**
     * Create table staticly
     *
     * @param array $columns
     * @param string|null $target
     * @return self
     */
    public static function make(array $columns, ?string $target = null): self
    {
        return new static($columns, $target);
    }

    /**
     * Render footer
     *
     * @param View $view
     * @return string
     */
    public function renderFooter(View $view): string
    {

        if ( count($this->footer) === 0 ) {
            return '';
        }

        $items = [];
        foreach ($this->footer as $element) {
            $items[] = is_string($element) ? $element : $element->build($view);
        }

        return \implode("\n", $items);
    }

    /**
     * Render table
     *
     * @param array $data
     * @return string
     */
    public function build(array $data, View $view): string
    {
        $columns = $this->columns;
        $footer = $this->renderFooter($view);
        $rows = Helper::arr_get($data, $this->target, []);

        return $view->partial('table', [
            'table' =>  new Accessor(compact('columns', 'rows', 'footer'))
        ]);
    }

}

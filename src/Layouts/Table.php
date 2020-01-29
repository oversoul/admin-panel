<?php

namespace Aecodes\AdminPanel\Layouts;

use Exception;
use Aecodes\AdminPanel\Panel;
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
     * Render table
     *
     * @param array $data
     * @return string
     */
    public function build(array $data, View $view): string
    {
        $columns = $this->columns;
        $rows = Helper::arr_get($data, $this->target, []);

        return $view->partial('table', [
            'table' =>  new Accessor(compact('columns', 'rows'))
        ]);
    }

}

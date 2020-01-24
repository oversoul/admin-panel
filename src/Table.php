<?php

namespace Aecodes\AdminPanel;

use Exception;

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
    public function build(array $data, Panel $page): string
    {
        $columns = $this->columns;
        $rows = Config::arrget($data, $this->target, []);

        return View::make(
            'table', 
            \compact('columns', 'rows')
        )->build($data, $page);
    }

}

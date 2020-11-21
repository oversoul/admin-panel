<?php

namespace Aecodes\AdminPanel\Layouts;

use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Layouts\Table\TD;

class Table
{

	/**
	 * Data target (key)
	 *
	 * @var string
	 */
	protected $target;

	/**
	 * Table Columns
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
		$this->target = $target;
		$this->columns = $columns;
	}

	/**
	 * Create table statically
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
	 * Create new column
	 * @param string $title
	 * @param string $name
	 * @return TD
	 */
	public static function column(string $title = '', string $name = ''): TD
	{
		return new TD($title, $name);
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
	 * Render header section
	 *
	 * @return array
	 */
	public function renderHeader(): array
	{
		$columns = [];
		foreach ($this->columns as $column) {
			$columns[] = $column->renderTitle();
		}

		return $columns;
	}

    /**
     * Render section
     *
     * @param array $data
     * @return array
     */
    public function renderFooter(array $data): array
    {
        $items = [];
        foreach ($this->footer as $element) {
            $items[] = is_scalar($element) ? $element : $element->build($data);
        }

        return $items;
    }

	/**
	 * @param $data
	 * @return array
	 */
	public function getRows($data): array
	{
		$trs = [];
		foreach ($data as $row) {
		    $tds = [];
		    foreach ($this->columns as $column) {
		        $tds[] = $column->build($row);
            }
		    $trs[] = $tds;
        }
		return $trs;
	}

    /**
     * @param array $data
     * @return array
     */
    protected function getDataRows(array $data): array
    {
        return (Helper::isAssoc($data) && !$this->target) ? [] : Helper::arr_get($data, $this->target, []);
	}

	/**
	 * Render table
	 *
	 * @param array $data
	 * @return array
	 */
	public function build(array $data): array
	{
        $data = $this->getDataRows($data);

		$type = 'Table';
		$rows = $this->getRows($data);
        $headers = $this->renderHeader();
        $footer = $this->renderFooter($data);

		return compact('type', 'headers', 'rows', 'footer');
	}

}

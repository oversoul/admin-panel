<?php

namespace Aecodes\AdminPanel\Layouts\Table;

use Aecodes\AdminPanel\Widgets\Widget;

class TD implements Widget
{

	/**
	 * Source field key
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Column title
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * Custom renderer
	 *
	 * @var callback
	 */
	protected $renderer = null;

	/**
	 * Create a new TD
	 *
	 * @param string $title
	 * @param string $name
	 */
	public function __construct(string $title = '', string $name = '')
	{
		$this->title = $title;
		$this->name = $name;
	}

	/**
	 * Create new TD statically
	 *
	 * @param string $title
	 * @param string $name
	 * @return self
	 */
	public static function make(string $title = '', string $name = ''): self
	{
		return new static($title, $name);
	}

	/**
	 * Set custom renderer.
	 *
	 * @param callable $callback
	 * @return self
	 */
	public function render(callable $callback): self
	{
		$this->renderer = $callback;
		return $this;
	}

	/**
	 * Render th
	 *
	 * @return string
	 */
	public function renderTitle(): string
	{
		return $this->title;
	}

	/**
	 * If Renderer is defined use it.
	 *
	 * @param mixed $row
	 * @return mixed
	 */
	protected function getRendererOutput($row)
	{
		$data = call_user_func($this->renderer, $row);

		if (!is_array($data)) {
			return $data;
		}

		$result = [];

		foreach ($data as $element) {
			$result[] = is_string($element) ? $element : $element->build($row);
		}

		return $result;
	}

	/**
	 * Get value
	 *
	 * @param $row
	 * @return mixed
	 */
	protected function getValue($row)
	{
		if (is_scalar($row)) {
			return $row;
		}

		if ($this->name === '') {
			return '';
		}

		if (is_object($row)) {
			return $row->{$this->name} ?? '';
		}

		return $row[$this->name] ?? '';
	}

	/**
	 * Render TD
	 *
	 * @param mixed $row
	 * @return mixed
	 */
	public function renderValue($row)
	{
		if ($this->renderer) {
			return $this->getRendererOutput($row);
		}

		return $this->getValue($row);
	}

	/**
	 * @param array $data
	 * @return array
	 */
	public function build(array $data): array
	{
		return [
			'type'  => 'Th',
			'title' => $this->renderTitle(),
			'value' => $this->renderValue($data)
		];
	}
}

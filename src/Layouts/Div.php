<?php

namespace Aecodes\AdminPanel\Layouts;

use Aecodes\AdminPanel\Widgets\Widget;

class Div implements Widget
{

	/**
	 * Children of div
	 *
	 * @var array
	 */
	protected $items = [];

	/**
	 * Div attributes
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Create a new Div
	 *
	 * @param array $items
	 */
	public function __construct(array $items)
	{
		$this->items = $items;
	}

	/**
	 * Create new Div statically
	 *
	 * @param array $items
	 * @return self
	 */
	public static function make(array $items): self
	{
		return new static($items);
	}

	/**
	 * Magic method to set attributes.
	 *
	 * @param string $key
	 * @param array $params
	 * @return self
	 */
	final public function __call(string $key, array $params = []): self
	{
		$this->attributes[$key] = $params[0];
		return $this;
	}

	/**
	 * Render div
	 *
	 * @param array $data
	 * @return array
	 */
	public function build(array $data): array
	{
		$parts = [];

		foreach ($this->items as $item) {
			$parts[] = is_string($item) ? $item : $item->build($data);
		}

		return [
			'type'       => 'Div',
			'value'      => $parts,
			'attributes' => $this->attributes,
		];
	}
}

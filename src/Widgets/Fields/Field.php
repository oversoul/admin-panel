<?php

namespace Aecodes\AdminPanel\Widgets\Fields;

use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\Widgets\Widget;

abstract class Field implements Widget
{

	/**
	 * Input label
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * Field name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Field name
	 *
	 * @var string
	 */
	protected $target;

	/**
	 * Help content under the field
	 *
	 * @var string|null
	 */
	protected $help = null;

	/**
	 * Fill content from model
	 *
	 * @var boolean
	 */
	protected $noFill = false;

	/**
	 * Field attributes
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * @var null|string
	 */
	protected $value = null;

	/**
	 * @var array
	 */
	protected $classes = [];

	/**
	 * Create new field
	 *
	 * @param string $target
	 */
	public function __construct(string $target)
	{
		$this->target = $target;
		$this->attributes['id'] = $target;
		$this->name = Helper::parse_dot($target);
	}

	/**
	 * Create new instance using static method.
	 *
	 * @param string $target
	 * @return self
	 */
	public static function make(string $target): self
	{
		return new static($target);
	}

	/**
	 * Set value
	 *
	 * @param $value
	 * @return $this
	 */
	public function value($value): self
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * Get value of field using data
	 *
	 * @param array $data
	 * @return void
	 */
	protected function getValue(array $data = [])
	{
		if ($this->value) {
			return;
		}

		if ($this->noFill) {
			$this->value = '';
			return;
		}

		$this->value = Dashboard::oldValue(
			$this->target,
			Helper::arr_get($data, $this->target, '')
		);
	}

	/**
	 * Set help message
	 *
	 * @param string $help
	 * @return self
	 */
	public function help(string $help): self
	{
		$this->help = $help;
		return $this;
	}

	/**
	 * Set attributes
	 *
	 * @param string $key
	 * @param mixed $value
	 * @return self
	 */
	public function set(string $key, $value): self
	{
		$this->attributes[$key] = $value;
		return $this;
	}

	/**
	 * Set field label, set the placeholder if its not defined.
	 *
	 * @param string $title
	 * @return self
	 */
	public function title(string $title): self
	{
		$this->title = $title;

		if (!isset($this->attributes['placeholder'])) {
			$this->set('placeholder', $title);
		}

		return $this;
	}

	/**
	 * Set input field as required
	 *
	 * @return self
	 */
	public function required(): self
	{
		return $this->set('required', 'required');
	}

	/**
	 * @param string $className
	 * @return $this
	 */
	public function class(string $className): self
	{
		$this->classes[] = $className;
		return $this;
	}

	/**
	 * Set field to not be filled
	 *
	 * @return self
	 */
	public function noFill(): self
	{
		$this->noFill = true;
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
		return $this->set($key, array_shift($params));
	}

	/**
	 * Stringify attributes.
	 *
	 * @return array
	 */
	protected function getAttributes(): array
	{
		$classes = implode(' ', $this->classes);
		$this->attributes['class'] = $classes;
		return $this->attributes;
	}

	/**
	 * Default build method
	 *
	 * @param array $data
	 * @return array
	 */
	abstract public function build(array $data): array;
}

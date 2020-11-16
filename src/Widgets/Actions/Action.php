<?php

namespace Aecodes\AdminPanel\Widgets\Actions;

use Exception;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\Widgets\Widget;

class Action implements Widget
{

	/**
	 * Is action a delete?
	 *
	 * @var boolean
	 */
	protected $delete = false;

	/**
	 * Class name
	 * @var array
	 */
	protected $classes = [];

	/**
	 * Action value
	 *
	 * @var string
	 */
	protected $value;

	/**
	 * Html attributes
	 *
	 * @var array
	 */
	protected $attributes = [];

	/**
	 * Create new Action
	 *
	 * @param string $value
	 */
	public function __construct(string $value)
	{
		$this->value = $value;
	}

	/**
	 * Create new Action statically
	 *
	 * @param string $value
	 * @return self
	 */
	public static function make(string $value): self
	{
		return new static($value);
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
	 * Set action as delete
	 *
	 * @return self
	 */
	protected function setDelete(): self
	{
		$this->delete = true;
		return $this;
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
	 * Default build method in case its not defined.
	 *
	 * @param array $data
	 * @return array
	 */
	public function build(array $data): array
	{
		return [];
	}

	/**
	 * Build attributes for action
	 *
	 * @return array
	 */
	protected function buildAttributes(): array
	{
		$defaultClasses = [];
		if ($this instanceof Link) {
			$defaultClasses = Dashboard::config('classes.link', []);
		} else if ($this instanceof Button) {
			$defaultClasses = Dashboard::config('classes.button', []);
		}

		$attributes = $this->attributes;
		$classes = array_merge($this->classes, (array) $defaultClasses);
		$attributes['class'] = implode(' ', $classes);

		return $attributes;
	}

	/**
	 * @param string $value
	 * @return Link
	 */
	public static function link(string $value): Link
	{
		return new Link($value);
	}

	/**
	 * @param string $value
	 * @return Button
	 */
	public static function button(string $value): Button
	{
		return new Button($value);
	}

	/**
	 * @param string $value
	 * @return Link
	 */
	public static function delete(string $value): Link
	{
		return (new Link($value))->setDelete();
	}
}

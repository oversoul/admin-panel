<?php

namespace Aecodes\AdminPanel\Layouts;

use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Widgets\Widget;
use Aecodes\AdminPanel\Widgets\Fields\Input;

class Form implements Widget
{
	/**
	 * Data target (key)
	 *
	 * @var string
	 */
	protected $target;

	/**
	 * Form Inputs
	 *
	 * @var array
	 */
	protected $inputs = [];

	/**
	 * Form Action
	 *
	 * @var string
	 */
	protected $action = '';

	/**
	 * Form method
	 *
	 * @var string
	 */
	protected $method = 'POST';

	/**
	 * Classes
	 *
	 * @var string
	 */
	protected $class = '';

	/**
	 * Undocumented function
	 *
	 * @param array $inputs
	 */
	public function __construct(array $inputs = [])
	{
		$this->inputs = $inputs;
	}

	/**
	 * Set form action
	 *
	 * @param string $action
	 * @return self
	 */
	public function action(string $action): self
	{
		$this->action = $action;
		return $this;
	}

	/**
	 * Set form method
	 *
	 * @param string $method
	 * @param string|null $url
	 * @return self
	 */
	public function method(string $method, ?string $url = null): self
	{
		if ($url) {
			$this->action($url);
		}

		$this->method = strtoupper($method);
		return $this;
	}

	/**
	 * Create form instance statically
	 *
	 * @param array $inputs
	 * @return self
	 */
	public static function make(array $inputs = []): self
	{
		return new static($inputs);
	}

	/**
	 * Set form target - data key
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
	 * Set form size
	 *
	 * @param string $className
	 * @return self
	 */
	function class(string $className): self
	{
		$this->class = $className;
		return $this;
	}

	/**
	 * @param string|null $method
	 * @return array
	 */
	protected function globalFields(?string $method): array
	{
		if (!$method) return [];

		// @todo: move this to config?
		return [
			Input::hidden('_method')->value($method)
		];
	}

	/**
	 * Get fields.
	 *
	 * @param array $data
	 * @param ?string $method
	 * @return array
	 */
	protected function getFields(array $data, ?string $method): array
	{
		$inputs = array_merge($this->globalFields($method), $this->inputs);

		$fields = [];
		foreach ($inputs as $item) {
			$fields[] = is_string($item) ? $item : $item->build($data);
		}

		return $fields;
	}

	/**
	 * Build form
	 *
	 * @param array $data
	 * @return array
	 */
	public function build(array $data): array
	{
		$realMethod = null;
		$method = $this->method;

		if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
			$realMethod = $method;
			$method = 'POST';
		}

		$data = Helper::arr_get($data, $this->target, []);

		return [
			'type'       => 'Form',
			'fields'     => $this->getFields($data, $realMethod),
			'attributes' => [
				'class'  => $this->class,
				'action' => $this->action,
				'method' => $method,
			],
		];
	}

	/**
	 * Magically set form method
	 *
	 * @param string $method
	 * @param array $params
	 * @return self
	 */
	public function __call(string $method, array $params = []): self
	{
		if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
			return $this->method($method, array_shift($params));
		}
		return $this;
	}

}

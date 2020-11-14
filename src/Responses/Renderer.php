<?php

namespace Aecodes\AdminPanel\Responses;

abstract class Renderer
{

	/** @var array */
	protected $data = [];

	/**
	 * @param string $key
	 * @param $value
	 * @return $this
	 */
	public function set(string $key, $value): self
	{
		$this->data[$key] = $value;
		return $this;
	}

	abstract public function render();
}
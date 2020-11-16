<?php

namespace Aecodes\AdminPanel\Widgets\Fields;

class Image extends Field
{

	/**
	 * Image path
	 *
	 * @var string
	 */
	protected $path = '';

	/**
	 * Uploading multiple images?
	 *
	 * @var boolean
	 */
	protected $multiple = false;

	/**
	 * Helper text
	 *
	 * @var string
	 */
	protected $help = "Upload files here and they won't be sent immediately";

	/**
	 * Enabling multiple files
	 *
	 * @return self
	 */
	public function multiple(): self
	{
		$this->multiple = true;
		return $this;
	}

	/**
	 * Setting the path
	 *
	 * @param string $path
	 * @return self
	 */
	public function path(string $path): self
	{
		$this->path = $path;
		return $this;
	}

	/**
	 * Build image upload field
	 *
	 * @param array $data
	 * @return array
	 */
	public function build(array $data): array
	{
		$this->getValue($data);

		$attributes = array_merge($this->getAttributes(), [
			'name'  => $this->name,
			'value' => $this->value,
		]);

		return [
			'type'       => 'Image',
			'help'       => $this->help,
			'title'      => $this->title,
			'path'       => $this->path,
			'attributes' => $attributes,
			'multiple'   => $this->multiple,
		];
	}
}

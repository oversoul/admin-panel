<?php

namespace Aecodes\AdminPanel\Widgets\Fields;

class Input extends Field
{

	/**
	 * Input type
	 *
	 * @var string
	 */
	protected $type = 'text';

	/**
	 * allowed input types.
	 *
	 * @var string[]
	 */
	protected $allowedTypes = [
		'text',
		'email',
		'number',
		'hidden',
		'password',
		'checkbox',
	];

	/**
	 * Set the input type
	 *
	 * @param string $type
	 * @return self
	 */
	public function type(string $type): self
	{
		$this->type = $this->getType($type);
		return $this;
	}

	/**
	 * @param $type
	 * @return string
	 */
	protected function getType($type): string
	{
		if (!in_array($type, $this->allowedTypes)) {
			return 'text';
		}

		return $type;
	}

	/**
	 * @param string $target
	 * @return self
	 */
	public static function email(string $target): self
	{
		return self::make($target)->type('email');
	}

	/**
	 * @param string $target
	 * @return static
	 */
	public static function number(string $target): self
	{
		return self::make($target)->type('number');
	}

	/**
	 * @param string $target
	 * @return static
	 */
	public static function password(string $target): self
	{
		return self::make($target)->type('password');
	}

	/**
	 * @param string $target
	 * @return static
	 */
	public static function text(string $target): self
	{
		return self::make($target)->type('text');
	}

	/**
	 * @param string $target
	 * @return static
	 */
	public static function hidden(string $target): self
	{
		return self::make($target)->type('hidden');
	}

	/**
	 * @param string $target
	 * @return Checkbox
	 */
	public static function checkbox(string $target): Checkbox
	{
		return new Checkbox($target);
	}

	/**
	 * Build input field
	 *
	 * @param array $data
	 * @return array
	 */
	public function build(array $data): array
	{
		$this->getValue($data);

		$attributes = array_merge($this->getAttributes(), [
			'type'  => $this->type,
			'name'  => $this->name,
			'value' => $this->value,
		]);

		return [
			'type'       => 'fields/input',
			'title'      => $this->title,
			'help'       => $this->help,
			'attributes' => $attributes,
		];
	}
}

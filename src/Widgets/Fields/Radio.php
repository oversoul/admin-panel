<?php


namespace Aecodes\AdminPanel\Widgets\Fields;


class Radio extends Field
{

	/**
	 * @var array
	 */
	protected $options = [];

	/**
	 * @var bool
	 */
	protected $useValues = false;

	/**
	 * Create new instance and set useValues.
	 *
	 * @param string $target
	 * @return self
	 */
	public static function values(string $target): self
	{
		return (new Radio($target))->useValues();
	}

	/**
	 * @return $this
	 */
	public function useValues(): self
	{
		$this->useValues = true;
		return $this;
	}


	/**
	 * Set options
	 *
	 * @param array $options
	 * @return self
	 */
	public function options($options = []): self
	{
		$this->options = $options;
		return $this;
	}

	/**
	 * @return array
	 */
	public function buildOptions(): array
	{
		$items = [];

		foreach ($this->options as $key => $value) {
			$key = $this->useValues ? $value : $key;
			$isSelected = is_array($this->value) ? in_array($key, $this->value) : $key === $this->value;
			$items[] = ['id' => $key, 'value' => $value, 'selected' => $isSelected];
		}

		return $items;
	}

	public function build(array $data): array
	{
		$this->getValue($data);

		$attributes = array_merge($this->getAttributes(), [
			'name' => $this->name,
		]);

		return [
			'type'       => 'Radio',
			'title'      => $this->title,
			'help'       => $this->help,
			'attributes' => $attributes,
			'options'    => $this->buildOptions(),
		];
	}
}

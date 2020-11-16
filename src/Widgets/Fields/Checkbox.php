<?php

namespace Aecodes\AdminPanel\Widgets\Fields;

use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Dashboard;

class Checkbox extends Field
{

	/**
	 * @return $this
	 */
	public function checked(): self
	{
		$this->attributes['checked'] = 'checked';
		return $this;
	}

	protected function isChecked(array $data): bool
	{
		if ($this->noFill || !$this->value) {
			return false;
		}

		$value = Helper::arr_get($data, $this->target, false);
		$value = Dashboard::oldValue($this->target, $value);

		return ($value === $this->value);
	}

	public function build(array $data): array
	{
		$this->getValue($data);

		$attributes = [
			'type'  => 'checkbox',
			'name'  => $this->name,
			'value' => $this->value,
		];

		if ($this->isChecked($data)) {
			$attributes['checked'] = 'checked';
		}

		$attributes = array_merge($this->getAttributes(), $attributes);

		return [
			'type'       => 'Checkbox',
			'title'      => $this->title,
			'help'       => $this->help,
			'attributes' => $attributes,
		];
	}
}

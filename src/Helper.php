<?php

namespace Aecodes\AdminPanel;

use ArrayAccess;

class Helper
{

	/**
	 * Get element from array by key or dotted key
	 *
	 * @param array $array
	 * @param ?string $key
	 * @param ?mixed $default
	 * @return mixed
	 */
	public static function arr_get(array $array, ?string $key, $default = null)
	{
		if (!$key) {
			return $array;
		}

		if (isset($array[$key])) {
			return $array[$key];
		}

		foreach (explode('.', $key) as $segment) {
			if (!is_array($array) && !($array instanceof ArrayAccess)) {
				return $default;
			}

			if (!isset($array[$segment])) {
				return $default;
			}

			$array = $array[$segment];
		}

		if (is_object($array) && method_exists($array, 'toArray')) {
			// force array usage.
			$array = $array->toArray();
		}

		return $array;
	}

	/**
	 * Turn dot into array-able syntax
	 *
	 * @param string $name
	 * @return string
	 */
	public static function parse_dot(string $name): string
	{
		$names = explode('.', $name);
		if (count($names) == 1) {
			return $name;
		}

		$attrs = array_shift($names);
		foreach ($names as $name) {
			$attrs .= '[' . $name . ']';
		}

		return $attrs;
	}

	/**
	 * @param array $data
	 * @return bool
	 */
	public static function isAssoc(array $data): bool
	{
		if (array() === $data) return false;
		return array_keys($data) !== range(0, count($data) - 1);
	}

}

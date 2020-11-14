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
		if (is_null($key)) {
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

		if (is_object($array)) {
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

}

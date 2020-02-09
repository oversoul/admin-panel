<?php

namespace Aecodes\AdminPanel;

use Countable;

/**
 * Accessor
 */
class Accessor implements Countable {
	
	/**
	 * data array
	 *
	 * @var array
	 */
    protected $data = [];
	
	/**
	 * Create new instance and set data if provided
	 *
	 * @param array $data
	 */
    public function __construct(array $data = []) {
        $this->data = $data;
    }


    /**
	 * Get from data using key | dotted key
	 * @param  string $key
	 * @param  mixed $default
	 * @return mixed
	 */
	public function get($key = null, $default = null) {
		if ( is_null($key) ) {
			return $this->data;
		}

		if (isset($this->data[$key])) {
			return $this->data[$key];
		}

		$data = $this->data;

		foreach (explode('.', $key) as $segment) {
			if ( ! is_array($data) || ! array_key_exists($segment, $data) ) {
				return $default;
			}
			$data = $data[$segment];
		}

		return $data;
	}

	/**
	 * Check if data has key | dotted key
	 * @param  string  $key
	 * @return boolean
	 */
	public function has($key)
	{
		if ( empty($this->data) || is_null($key) ) return false;
		if ( array_key_exists($key, $this->data) ) return true;

		$array = $this->data;
		foreach (explode('.', $key) as $segment) {
			if ( ! is_array($array) || ! array_key_exists($segment, $array) ) {
				return false;
			}
			$array = $array[$segment];
		}

		return true;
	}

	/**
	 * Get all data array
	 * @return array
	 */
	public function all()
	{
		return $this->data;
	}

	/**
	 * Return data as array
	 *
	 * @return array
	 */
	public function toArray()
	{
		return $this->data;
	}

	/**
	 * Magic get item
	 * @param  string $key
	 * @return mixed
	 */
	public function __get($key)
	{
		return $this->get($key);
	}

	public function count()
	{
		return count($this->data);
	}
}
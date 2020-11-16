<?php

namespace Aecodes\AdminPanel;

class Dashboard
{

	/**
	 * config class instance
	 *
	 * @var array
	 */
	protected static $config = [];

	/**
	 * Singleton of Config object
	 *
	 * @var self|null
	 */
	protected static $instance = null;

	/**
	 * Force calling instance
	 * @param ?array $config
	 */
	protected function __construct(array $config = null)
	{
		if ($config) {
			self::$config = $config;
			return;
		}

		// load default config.
		$configFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'panel.php';
		self::$config = require($configFile);
	}

	/**
	 * Get instance from Config
	 *
	 * @param ?array $config
	 * @return self
	 */
	final public static function setup(array $config = null): self
	{
		if (!self::$instance) {
			self::$instance = new self($config);
		}

		return self::$instance;
	}

	/**
	 * Config instance
	 * @param  ?string $key
	 * @param null $default
	 * @return mixed
	 */
	public static function config(string $key = null, $default = null)
	{
		return Helper::arr_get(self::$config, $key, $default);
	}

	/**
	 * get old value from config
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public static function oldValue(string $key, $default)
	{
		$callback = self::config('old_value');

		if (!is_callable($callback)) {
			return $default;
		}

		return $callback($key, $default);
	}

	public static function loadCallback(string $key): array
	{
		$callback = self::config($key, []);

		if (is_array($callback)) {
			return $callback;
		}

		if (!is_callable($callback)) {
			return [];
		}

		return $callback();
	}

	/**
	 * get errors.
	 *
	 * @return array
	 */
	public static function errors(): array
	{
		return static::loadCallback('errors');
	}

	/**
	 * get menu.
	 *
	 * @return array
	 */
	public static function globalFields(): array
	{
		return static::loadCallback('global_fields');
	}

	/**
	 * get menu.
	 *
	 * @return array
	 */
	public static function menu(): array
	{
		return static::loadCallback('menu');
	}

}

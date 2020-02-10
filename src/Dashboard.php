<?php
namespace Aecodes\AdminPanel;

class Dashboard
{

    /**
     * config class instance
     *
     * @var AdminConfig|null
     */
    protected static $config;

    /**
     * Singleton of Config object
     *
     * @var self|null
     */
    protected static $instance = null;

    /**
     * Force calling instance
     */
    protected function __construct(AdminConfig $config)
    {
        self::$config = $config;
    }

    public static function stop()
    {
        self::$config = null;
        self::$instance = null;
    }

    /**
     * Get instance from Config
     *
     * @return self
     */
    final public static function make(AdminConfig $config): self
    {
        if (!self::$instance) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    /**
     * Config instance
     *
     * @return AdminConfig
     */
    public static function config(): AdminConfig
    {
        return self::$config;
    }

}

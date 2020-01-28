<?php
namespace Aecodes\AdminPanel;

class Dashboard
{

    /**
     * config class instance
     *
     * @var AdminConfig
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
    public function __construct(AdminConfig $config)
    {
        self::$config = $config;
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
<?php
namespace Aecodes\AdminPanel;

class Dashboard
{

    /**
     * Singleton of Config object
     *
     * @var self|null
     */
    protected static $instance = null;

    protected static $config;

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

    public static function config(): AdminConfig
    {
        return self::$config;
    }

}

<?php

namespace Aecodes\AdminPanel;

use Error;
use Exception;

class Config
{

    /**
     * Singleton of Config object
     *
     * @var self|null
     */
    protected static $instance = null;

    /**
     * Make sure register is called
     *
     * @var boolean
     */
    protected $isRegistered = false;

    /**
     * Admin menu items
     *
     * @var array
     */
    protected $menus = [];

    /**
     * Flash messages callback
     *
     * @var callable
     */
    protected $flashCallback = null;

    /**
     * Form errors callback
     *
     * @var callable
     */
    protected $errorsCallback = null;

    /**
     * Get field's old data callback
     *
     * @var callable
     */
    protected $oldDataCallback = null;

    /**
     * Fields template
     *
     * @var array
     */
    protected $fieldsTemplate = [];

    /**
     * Views path
     *
     * @var string
     */
    protected $path = __DIR__ . DIRECTORY_SEPARATOR . 'presenters' . DIRECTORY_SEPARATOR;

    /**
     * Force calling instance
     */
    public function __construct()
    {}

    /**
     * Get instance from Config
     *
     * @return self
     */
    public static function instance(): self
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }


    public function register(array $config)
    {
        if ($this->isRegistered === true) {
            return;
        }

        if (isset($config['template_path'])) {
            $this->path = $config['template_path'];
        }

        if (isset($config['old_callback'])) {
            $this->setOldCallback($config['old_callback']);
        }

        if (isset($config['flash_callback'])) {
            $this->setFlashCallback($config['flash_callback']);
        }
        if (isset($config['form_errors'])) {
            $this->setFormErrors($config['form_errors']);
        }

        $this->isRegistered = true;
    }

    /**
     * set old data callback
     *
     * @param callback $callback
     * @return void
     */
    public function setOldCallback(callable $callback): void
    {
        $this->oldDataCallback = $callback;
    }

    /**
     * get old value
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getOldValue(string $name, $default)
    {
        if (!is_callable($this->oldDataCallback)) {
            return $default;
        }
        return \call_user_func_array($this->oldDataCallback, [
            $name,
            $default,
        ]);
    }

    /**
     * Set flash message callback
     *
     * @param callback $callback
     * @return void
     */
    public function setFlashCallback(callable $callback): void
    {
        $this->flashCallback = $callback;
    }

    /**
     * Return flash message
     *
     * @return array|null
     */
    public function flash(): ?array
    {
        if (!is_callable($this->flashCallback)) {
            return null;
        }

        $data = \call_user_func($this->flashCallback);
        if (empty($data)) {
            return null;
        }

        if (!isset($data['message'])) {
            throw new Error("Message not defined for Flash");
        }

        $data['type'] = isset($data['type']) ? $data['type'] : 'info';

        return $data;
    }

    /**
     * Set form errors
     *
     * @param callable $callback
     * @return void
     */
    public function setFormErrors(callable $callback): void
    {
        $this->errorsCallback = $callback;
    }

    /**
     * Get form errors
     *
     * @return array
     */
    public function errors(): array
    {
        if (!is_callable($this->errorsCallback)) {
            return [];
        }

        $data = \call_user_func($this->errorsCallback);
        if (empty($data)) {
            return [];
        }

        return $data;
    }

    public function addMenu(string $name, string $url, array $children = []): self
    {
        $this->menus[] = \compact('name', 'url', 'children');

        return $this;
    }

    public function menu(): array
    {
        return $this->menus;
    }

    /**
     * Get views path
     *
     * @return string
     */
    public function templatePath(): string
    {
        return $this->path;
    }

    public function templates(string $key): string
    {
        if (!isset($this->fieldsTemplate[$key])) {
            throw new Exception("Key {$key} is not defined in fields template.");
        }
        return $this->fieldsTemplate[$key];
    }

    public function isRegistered(): bool
    {
        return $this->isRegistered;
    }

    public static function arrget($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }
        
        if (isset($array[$key])) {
            return $array[$key];
        }
        
        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) && !($array instanceof \ArrayAccess)) {
                return $default;
            }
            
            if (!isset($array[$segment])) {
                return $default;
            }
            
            $array = $array[$segment];
        }

        return $array;
    }

    public static function parse_dot($name)
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

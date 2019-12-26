<?php

namespace Aecodes\AdminPanel;

use Error;

class Config
{

    protected static $menus = [];
    protected static $flashCallback = null;
    protected static $errorsCallback = null;
    protected static $oldDataCallback = null;
    protected static $path = __DIR__ . DIRECTORY_SEPARATOR . 'presenters' . DIRECTORY_SEPARATOR;
    
    /**
     * set old data callback
     *
     * @param callback $callback
     * @return void
     */
    public static function setOldCallback(callable $callback): void
    {
        static::$oldDataCallback = $callback;
    }

    /**
     * get old value
     *
     * @param string $name
     * @param string $default
     * @return string
     */
    public static function getOldValue(string $name, string $default): string
    {
        if (!is_callable(static::$oldDataCallback)) {
            return $default;
        }
        return \call_user_func_array(static::$oldDataCallback, [
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
    public static function setFlashCallback(callable $callback): void
    {
        static::$flashCallback = $callback;
    }

    /**
     * Return flash message
     *
     * @return array|null
     */
    public static function flash(): ?array
    {
        if (!is_callable(static::$flashCallback)) {
            return null;
        }

        $data = \call_user_func(static::$flashCallback);
        if ( empty($data) ) return null;

        if ( ! isset($data['message']) ) {
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
    public static function setFormErrors(callable $callback): void
    {
        static::$errorsCallback = $callback;
    }

    /**
     * Get form errors
     *
     * @return array
     */
    public static function errors(): array
    {
        if (!is_callable(static::$errorsCallback)) {
            return [];
        }

        $data = \call_user_func(static::$errorsCallback);
        if ( empty($data) ) return [];

        return $data;
    }

    public static function addMenu(string $name, string $url): void
    {
        static::$menus[] = \compact('name', 'url');
    }

    public static function menu(): array
    {
        return static::$menus;
    }

    public function viewPath(): string
    {
        return static::$path;
    }
}

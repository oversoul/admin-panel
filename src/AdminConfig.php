<?php

namespace Aecodes\AdminPanel;

use Aecodes\AdminPanel\Helper;

abstract class AdminConfig
{

    /**
     * get old value
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function oldValue(string $name, $default)
    {
        return $default;
    }

    /**
     * Return flash message
     *
     * @return array|null
     * @example
     * ['message' => 'flash message', 'type' => 'success']
     */
    public function flash(): array
    {
        return [];
    }

    /**
     * Get form errors
     *
     * @return array
     *
     * @example
     * ['Field is required', 'Field is not a number', ...]
     */
    public function errors(): array
    {
        return [];
    }

    /**
     * Get views path
     *
     * @return string
     */
    public function viewsPath(): string
    {
        return Helper::defaultViewsPath();
    }

    /**
     * Register global form fields shared by every form.
     * These fields will show up everywhere
     * including the default delete form.
     *
     * @return array
     */
    public function globalFormFields(): array
    {
        return [];
    }

    // string $name, string $url, array $children = []
    /**
     * Get Admin menu items
     *
     * @return array
     *
     * @example
     * [
     *    [
     *        'name' => 'Dashboard',
     *        'url' => '/',
     *        'children' => [
     *            ['name' => 'Subitem', 'url' => '/sub'].
     *            ...
     *        ]
     *    ],
     *    ...
     * ]
     */
    public function menu(): array
    {
        return [];
    }

    /**
     * Disable default exception handling
     *
     * @return boolean
     */
    public function withoutExceptionHandling(): bool
    {
        return false;
    }
}

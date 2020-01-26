<?php

namespace Aecodes\AdminPanel;

abstract class AdminConfig
{

    /**
     * Views default path
     *
     * @var string
     */
    private $defaultPath = __DIR__ . DIRECTORY_SEPARATOR . 'presenters' . DIRECTORY_SEPARATOR;

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
     * default expected return:
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
     * default expected return:
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
        return $this->defaultPath;
    }

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
     * default expected return:
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

    public function withoutExceptionHandling(): bool
    {
        return false;
    }
}

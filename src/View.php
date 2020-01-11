<?php

namespace Aecodes\AdminPanel;

use Exception;

class View
{

    /**
     * View path to render
     *
     * @var string
     */
    protected $path;

    /**
     * Data to push to the view
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new view
     *
     * @param string $path
     * @param array $data
     */
    public function __construct(string $path, array $data = [])
    {
        $this->path = $path;
        $this->data = $data;
    }

    /**
     * Create form instance statically
     *
     * @param string $path
     * @param array $data
     * @return self
     */
    public static function make(string $path, array $data = []): self
    {
        return new static($path, $data);
    }

    /**
     * Build view
     *
     * @param array $source
     * @param Panel|null $page
     * @return string
     */
    public function build(array $source = [], ?Panel $page = null): string
    {
        $data = $this->data;
        $viewPath = Config::viewPath();
        $view_file_path = $viewPath . "/{$this->path}.php";

        if (!file_exists($view_file_path)) {
            throw new Exception("View provided not found: {$view_file_path}");
        }

        extract($data);
        ob_start();
        require $view_file_path;
        return ob_get_clean();
    }

    public function __toString()
    {
        return $this->build();
    }

}

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
     * @param array $inputs
     * @return self
     */
    public static function make(string $path, array $data = []): self
    {
        return new static($inputs, $data);
    }

    /**
     * Build view
     *
     * @param mixed $source
     * @param Panel $page
     * @return string
     * @throws Exception if the view not found
     */
    public function build($source, Panel $page): string
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

}

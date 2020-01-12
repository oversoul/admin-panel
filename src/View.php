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
     * Print out the error.
     *
     * @param Error
     * @return string
     */
    public static function renderError($e): string
    {
        return \sprintf(
            "<h3>%s</h3>
            <pre>%s</pre>",
            $e->getMessage(),
            $e->getTraceAsString()
        );
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
        $template = Config::instance()->templatePath();
        $view_file_path = $template . "/{$this->path}.php";

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
        try {
            return $this->build();
        } catch (Exception $e) {
            return self::renderError($e);
        }
    }

}

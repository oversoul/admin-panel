<?php

namespace Aecodes\AdminPanel\Layouts;

use Exception;
use Aecodes\AdminPanel\Panel;
use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Accessor;
use Aecodes\AdminPanel\Dashboard;

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
    protected function __construct(string $path, array $data = [])
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

    public function partial(string $name, array $data = []): string
    {
        $view = $this;
        $page = $this->page;
        $view_file_path = $this->getRenderableViewFile($name);
        // dd($view_file_path);
        
        \extract($data);
        ob_start();
        require $view_file_path;
        return ob_get_clean();
    }

    /**
     * Print out the error.
     *
     * @param Error
     * @return string
     */
    public static function renderError($e): string
    {
        $without = Dashboard::config()->withoutExceptionHandling();

        if ( $without === true ) {
            throw $e;
        }

        ob_get_clean();
        return \sprintf(
            "<h3>%s</h3>
            <pre>%s</pre>",
            $e->getMessage(),
            $e->getTraceAsString()
        );
    }

    public function setPath(string $path): self
    {
        $this->templatePath = $path;
        return $this;
    }

    protected function getRenderableViewFile($view): string
    {
        $view = "/{$view}.php";
        $template = Dashboard::config()->viewsPath();

        $view_file_path = $template . $view;
        
        if (!file_exists($view_file_path)) {
            return Helper::defaultViewsPath() . $view;
        }
        
        return $view_file_path;
    }

    /**
     * Build view
     *
     * @param string $path
     * @param array $source
     * @return string
     */
    public function render(string $path, array $data = []): string
    {
        $view = $this;
        $data = array_merge($this->data, $data);
        $view_file_path = $this->getRenderableViewFile($path);
        
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

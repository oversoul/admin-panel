<?php

namespace Aecodes\AdminPanel\Layouts;

use Throwable;
use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Dashboard;

class View
{

    /**
     * Data to push to the view
     *
     * @var array
     */
    protected $data = [];

    /**
     * Renders a partial
     *
     * @param string $name
     * @param array $data
     * @return string
     */
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
     * @param Throwable $e
     * @return string
     */
    public static function renderError(Throwable $e): string
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

    /**
     * Get full view path
     *
     * @param string $view
     * @return string
     */
    protected function getRenderableViewFile(string $view): string
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
     * @param array $data
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

    /**
     * Set data
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * Get value from key
     *
     * @param string $key
     * @return mixed
     */
    public function __get(string $key)
    {
        return $this->data[$key] ?? null;
    }

}

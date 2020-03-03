<?php

namespace Aecodes\AdminPanel;

use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\Helper;
use Throwable;

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
     * Includes a view
     *
     * @param string $name
     * @param array $data
     * @return void
     */
    public function load(string $name, array $data = []): void
    {
        $view = $this;
        $view_file_path = $this->getRenderableViewFile($name);

        if (!\file_exists($view_file_path)) {
            echo "View file not found: {$name}";
            return;
        }

        \extract($data);
        require $view_file_path;
    }

    /**
     * Print out the error.
     *
     * @param Throwable $e
     * @return string
     */
    public static function renderError(Throwable $e): string
    {
        ob_clean();
        $without = Dashboard::config()->withoutExceptionHandling();

        if ($without === true) {
            throw $e;
        }

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
        $config = Dashboard::config();
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

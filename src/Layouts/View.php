<?php

namespace Aecodes\AdminPanel\Layouts;

use Exception;
use Aecodes\AdminPanel\Panel;
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
     * Views path
     *
     * @var string
     */
    protected $defaultViewsPath = __DIR__ . DIRECTORY_SEPARATOR . 'presenters' . DIRECTORY_SEPARATOR;

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

    protected function getRenderableViewFile(): string
    {
        $view = "/{$this->path}.php";
        $template = Dashboard::config()->viewsPath();

        $view_file_path = $template . $view;
        
        if (!file_exists($view_file_path)) {
            return $this->defaultViewsPath . $view;
        }
        
        return $view_file_path;
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

        $view_file_path = $this->getRenderableViewFile();

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

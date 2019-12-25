<?php

namespace Aecodes\AdminPanel;

use Error;
use Exception;
use Aecodes\AdminPanel\Config;

abstract class Panel
{

    /**
     * Panel Name
     *
     * @var string
     */
    public $name = '';

    /**
     * Panel description
     *
     * @var string
     */
    public $description = '';

    public function bar(): array
    {
        return [];
    }

    /**
     * Abstract method for getting the data query
     *
     * @return array
     */
    abstract public function query(): array;

    /**
     * Rendering method
     *
     * @return array
     */
    abstract public function render(): array;

    /**
     * Print out the error.
     *
     * @param Error
     * @return string
     */
    final protected function renderError($e): string
    {
        return \sprintf(
            "<h3>%s</h3>
            <pre>%s</pre>",
            $e->getMessage(),
            $e->getTraceAsString()
        );
    }

    /**
     * Magic method to render the content
     *
     * @return string
     */
    public function __toString(): string
    {
        $query = $this->query();
        try {
            return $this->renderLayout($query);
        } catch (Error $e) {
            return $this->renderError($e);
        } catch (Exception $e) {
            return $this->renderError($e);
        }
    }

    /**
     * Get Bar content.
     *
     * @return array
     */
    final protected function getBar(): array
    {
        $widgets = [];
        foreach ($this->bar() as $widget) {
            $widgets[] = (string) $widget;
        }
        return $widgets;
    }

    /**
     * Get flash message content
     *
     * @return array|null
     */
    protected function getFlashMessage(): ?array
    {
        return Config::flash();
    }

    /**
     * Render layout with header and footer.
     *
     * @param string
     * @return string
     */
    final protected function renderLayout(array $query): string
    {
        $top_bar = $this->getBar();

        $parts = [];
        foreach ($this->render() as $part) {
            $parts[] = $part->build($query);
        }

        $content = \implode("\n", $parts);

        $flashMessage = $this->getFlashMessage();
        $formErrors = Config::errors();
        $menus = Config::menu();
        
        ob_start();
        require dirname(__FILE__) . "/presenters/layout.php";
        return ob_get_clean();
    }
}

<?php

namespace Aecodes\AdminPanel;

use Error;
use Exception;

abstract class Panel
{

    /**
     * name of the default layout
     *
     * @var string
     */
    public $layout = 'default';

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
            return View::renderError($e);
        } catch (Exception $e) {
            return View::renderError($e);
        }
    }

    /**
     * Get Bar content.
     *
     * @return array
     */
    final public function getBar(): array
    {
        $widgets = [];
        foreach ($this->bar() as $widget) {
            $widgets[] = (string) $widget;
        }
        return $widgets;
    }

    /**
     * Render layout with header and footer.
     *
     * @param array query
     * @return string
     * @throws Exception layout not found
     */
    final protected function renderLayout(array $query): string
    {
        $parts = [];
        $config = Config::instance();

        if (! $config->isRegistered() ) {
            throw new Exception("The AdminPanel is not registered properly");
        }

        foreach ($this->render() as $part) {
            $parts[] = is_string($part) ? $part : $part->build($query, $this);
        }

        $content = \implode("\n", $parts);
     
        $flashMessage = $config->flash();
        $menus = $config->menu();

        return View::make(
            "layouts/{$this->layout}",
            \compact('content', 'flashMessage', 'menus')
        )->build($query, $this);
    }
}

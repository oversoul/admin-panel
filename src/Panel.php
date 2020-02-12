<?php

namespace Aecodes\AdminPanel;

use Throwable;
use Aecodes\AdminPanel\Accessor;

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

    /**
     * get top bar elements
     *
     * @return array
     */
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
     * @throws Throwable
     */
    public function __toString(): string
    {
        $query = $this->query();
        try {
            return $this->renderLayout($query);
        } catch (Throwable $e) {
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
     * @param array $query
     * @return string
     */
    final protected function renderLayout(array $query): string
    {
        $view = new View;
        $config = Dashboard::config();
        
        $view->menu = $config->menu();
        $view->topBar = $this->getBar();
        $view->errors = $config->errors();
        $view->flashMessage = $config->flash();
        $view->globalFormFields = implode("\n", $config->globalFormFields());

        $view->page = new Accessor([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $parts = [];

        foreach ($this->render() as $part) {
            $parts[] = is_string($part) ? $part : $part->build($query, $view);
        }

        $view->content = \implode("\n", $parts);

        return $view->render("layouts/{$this->layout}");
    }
}

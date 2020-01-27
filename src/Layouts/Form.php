<?php

namespace Aecodes\AdminPanel\Layouts;

use Exception;
use Aecodes\AdminPanel\Panel;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\Layouts\View;

class Form
{

    /**
     * Form Inputs
     *
     * @var array
     */
    protected $inputs = [];

    /**
     * Form Action
     *
     * @var string
     */
    protected $action = '';

    /**
     * Form method
     *
     * @var string
     */
    protected $method = 'POST';

    /**
     * Classes
     *
     * @var string
     */
    protected $class = '';

    /**
     * Undocumented function
     *
     * @param array $inputs
     * @throws Exception if no inputs provided
     */
    public function __construct(array $inputs = [])
    {
        if (empty($inputs)) {
            throw new Exception("At least one form item needs to be defined.");
        }

        $this->inputs = $inputs;
    }

    /**
     * Set form action
     *
     * @param string $action
     * @return self
     */
    public function action(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Set form method
     *
     * @param string $method
     * @return self
     */
    public function method(string $method): self
    {
        $this->method = \strtoupper($method);
        return $this;
    }

    /**
     * Create form instance statically
     *
     * @param array $inputs
     * @return self
     */
    public static function make(array $inputs = []): self
    {
        return new static($inputs);
    }

    /**
     * Set form size
     *
     * @param integer $percent
     * @return self
     */
    public function class(string $percent): self
    {
        $this->class = $class;
        return $this;
    }

    /**
     * Build form
     *
     * @param mixed $source
     * @return string
     */
    public function build($source, Panel $page): string
    {
        $real_method = null;
        $class       = $this->class;
        $inputs      = $this->inputs;
        $action      = $this->action;
        $method      = $this->method;
        $formErrors  = Dashboard::config()->errors();
        $globalFormFields = $page->getGlobalFormFields();

        if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
            $real_method = $method;
            $method = 'POST';
        }

        $fields = [];
        foreach($inputs as $item) {
            $fields[] = is_string($item) ? $item : $item->build($source);
        }
        
        $inputs = \implode("\n", $fields);

        $data = \compact('real_method', 'inputs', 'action', 'method', 'class', 'globalFormFields', 'formErrors');
        return View::make('form', $data)->build($source, $page);
    }

    /**
     * Magically set form method
     *
     * @param string $method
     * @param array $params
     * @return self
     */
    public function __call(string $method, array $params = []): self
    {
        if (\in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
            return $this->method($method);
        }
        return $this;
    }

}

<?php

namespace Aecodes\AdminPanel\Layouts;

use Exception;
use Aecodes\AdminPanel\View;
use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Accessor;

class Form
{
    /**
     * Data target (key)
     *
     * @var string
     */
    protected $target;

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
     * Set form target - data key
     *
     * @param string $target
     * @return self
     */
    public function target(string $target): self
    {
        $this->target = $target;
        return $this;
    }

    /**
     * Set form size
     *
     * @param string $className
     * @return self
     */
    function class (string $className): self
    {
        $this->class = $className;
        return $this;
    }

    /**
     * Build form
     *
     * @param mixed $source
     * @return string
     */
    public function build($source, View $view): string
    {
        $real_method = null;
        $class = $this->class;
        $inputs = $this->inputs;
        $action = $this->action;
        $method = $this->method;

        if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
            $real_method = $method;
            $method = 'POST';
        }

        $fields = [];
        $data   = Helper::arr_get($source, $this->target, []);

        foreach ($inputs as $item) {
            $fields[] = is_string($item) ? $item : $item->build($data, $view);
        }

        $inputs = \implode("\n", $fields);

        $form = new Accessor(
            compact('class', 'method', 'inputs', 'action', 'real_method')
        );

        return $view->partial('form', compact('form'));
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

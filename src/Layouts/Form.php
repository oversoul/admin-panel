<?php

namespace Aecodes\AdminPanel\Layouts;

use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\Widgets\Widget;
use Aecodes\AdminPanel\Widgets\Fields\Input;

class Form implements Widget
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
     * @var bool
     */
    protected $withGlobalFields = true;

    /**
     * Undocumented function
     *
     * @param array $inputs
     */
    public function __construct(array $inputs = [])
    {
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
     * @param string|null $url
     * @return self
     */
    public function method(string $method, ?string $url = null): self
    {
        if ($url) {
            $this->action($url);
        }

        $this->method = strtoupper($method);
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
    function class(string $className): self
    {
        $this->class = $className;
        return $this;
    }

    /**
     * @param string|null $method
     * @return array
     */
    protected function getGlobalFields(?string $method): array
    {
        if (!$this->withGlobalFields) {
            return [];
        }

        $inputs = Dashboard::globalFields();

        if (!$method) return $inputs;

        $inputs[] = Input::hidden('_method')->value($method);
        return $inputs;
    }

    /**
     * Get fields.
     *
     * @param array $data
     * @param ?string $method
     * @return array
     */
    protected function getFields(array $data, ?string $method): array
    {
        $inputs = array_merge($this->getGlobalFields($method), $this->inputs);

        $fields = [];
        foreach ($inputs as $item) {
            $fields[] = is_string($item) ? $item : $item->build($data);
        }

        return $fields;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function globalFields(bool $value): self
    {
        $this->withGlobalFields = $value;
        return $this;
    }

    /**
     * Build form
     *
     * @param array $data
     * @return array
     */
    public function build(array $data): array
    {
        $realMethod = null;
        $method = $this->method;

        if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
            $realMethod = $method;
            $method = 'POST';
        }

        $data = Helper::arr_get($data, $this->target, []);

        return [
            'type'       => 'Form',
            'fields'     => $this->getFields($data, $realMethod),
            'attributes' => [
                'class'  => $this->class,
                'action' => $this->action,
                'method' => $method,
            ],
        ];
    }

    /**
     * Using get method
     * @param array $inputs
     * @return static
     */
    public static function get(array $inputs = []): self
    {
        return (new static($inputs))->method('get');
    }

    /**
     * Using post method.
     *
     * @param array $inputs
     * @return static
     */
    public static function post(array $inputs = []): self
    {
        return (new static($inputs))->method('post');
    }

    /**
     * Using put method.
     *
     * @param array $inputs
     * @return static
     */
    public static function put(array $inputs = []): self
    {
        return (new static($inputs))->method('put');
    }

    /**
     * Using patch
     *
     * @param array $inputs
     * @return static
     */
    public static function patch(array $inputs = []): self
    {
        return (new static($inputs))->method('patch');
    }

    /**
     * Using delete method.
     *
     * @param array $inputs
     * @return static
     */
    public static function delete(array $inputs = []): self
    {
        return (new static($inputs))->method('delete');
    }

}

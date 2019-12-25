<?php

namespace Aecodes\AdminPanel;

use Exception;

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
     * Form width
     *
     * @var integer
     */
    protected $size   = 100;

    /**
     * Allowed sizes
     * 
     * @var array
     */
    protected $allowedSizes = [25, 50, 75, 100];

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
    public function size(int $percent): self
    {
        if ( ! in_array($percent, $this->allowedSizes)) {
            $percent = 100;
        }

        $this->size = $percent;
        return $this;
    }

    /**
     * Build form
     *
     * @param mixed $source
     * @return string
     */
    public function build($source): string
    {
        $real_method = null;
        $inputs      = $this->inputs;
        $action      = $this->action;
        $method      = $this->method;
        $size        = 'w-' . $this->size;

        if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
            $real_method = $method;
            $method = 'POST';
        }

        ob_start();
        require dirname(__FILE__) . "/presenters/form.php";
        return ob_get_clean();
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

<?php

namespace Aecodes\AdminPanel\Fields;

use Aecodes\AdminPanel\View;
use Aecodes\AdminPanel\Helper;
use Aecodes\AdminPanel\Dashboard;

class Field
{

    /**
     * Input label
     *
     * @var string
     */
    protected $title;

    /**
     * Field name
     *
     * @var string
     */
    protected $name;

    /**
     * Field name
     *
     * @var string
     */
    protected $target;

    /**
     * Help content under the field
     *
     * @var string|null
     */
    protected $help = null;

    /**
     * Fill content from model
     *
     * @var boolean
     */
    protected $noFill = false;

    /**
     * Field attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Create new field
     *
     * @param string $target
     */
    public function __construct(string $target)
    {
        $this->target = $target;
        $this->name = Helper::parse_dot($target);
    }

    /**
     * Create new instance using static method.
     *
     * @param string $target
     * @return self
     */
    public static function make(string $target): self
    {
        return new static($target);
    }

    /**
     * Get value of field using data
     *
     * @param array $data
     * @return mixed
     */
    protected function value(array $data = [])
    {
        if ($this->noFill) {
            return '';
        }

        return Dashboard::config()->oldValue(
            $this->target,
            Helper::arr_get($data, $this->target, '')
        );
    }

    /**
     * Set help message
     *
     * @param string $help
     * @return self
     */
    public function help(string $help): self
    {
        $this->help = $help;
        return $this;
    }

    /**
     * Set attributes
     *
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public function set(string $key, $value): self
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * Set field label, set the placeholder if its not defined.
     *
     * @param string $title
     * @return self
     */
    public function title(string $title): self
    {
        $this->title = $title;

        if (!isset($this->attributes['placeholder'])) {
            $this->set('placeholder', $title);
        }

        return $this;
    }

    /**
     * Set input field as required
     *
     * @return self
     */
    public function required(): self
    {
        return $this->set('required', 'required');
    }

    /**
     * Set field to not be filled
     *
     * @return self
     */
    public function noFill(): self
    {
        $this->noFill = true;
        return $this;
    }

    /**
     * Magic method to set attributes
     *
     * @param string $key
     * @param array $params
     * @return self
     */
    public function __call(string $key, array $params = []): self
    {
        return $this->set($key, $params[0]);
    }

    /**
     * Default build method
     *
     * @param array $data
     * @return string
     */
    public function build(array $data, View $view): string
    {
        return '';
    }
}

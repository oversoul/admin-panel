<?php

namespace Aecodes\AdminPanel\Widgets\Fields;

class Input extends Field
{

    /**
     * Input type
     *
     * @var string
     */
    protected $type = 'text';

    /**
     * Set the input type
     *
     * @param string $type
     * @return self
     */
    public function type(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public static function __callStatic($method, array $params = []): self
    {
        $target = $params[0];
        return self::make($target)->type($method);
    }

	/**
	 * @param string $target
	 * @return self
	 */
	public static function email(string $target): self
	{
		return self::make($target)->type('email');
	}

	/**
	 * @param string $target
	 * @return static
	 */
	public static function number(string $target): self
	{
		return self::make($target)->type('number');
	}

	/**
	 * @param string $target
	 * @return static
	 */
	public static function password(string $target): self
	{
		return self::make($target)->type('password');
	}

	/**
	 * @param string $target
	 * @return static
	 */
	public static function text(string $target): self
	{
		return self::make($target)->type('text');
	}

	/**
	 * @param string $target
	 * @return static
	 */
	public static function hidden(string $target): self
	{
		return self::make($target)->type('hidden');
	}

	/**
	 * Build input field
	 *
	 * @param array $data
	 * @return array
	 */
    public function build(array $data): array
    {
        $this->getValue($data);

        $attributes = array_merge($this->getAttributes(), [
            'type' => $this->type,
            'name' => $this->name,
            'value' => $this->value,
        ]);

        return [
            'type'       => 'fields/input', 
            'title'      => $this->title,
            'help'       => $this->help,
            'attributes' => $attributes,
        ];
    }
}

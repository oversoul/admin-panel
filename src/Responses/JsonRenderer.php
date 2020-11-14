<?php

namespace Aecodes\AdminPanel\Responses;


class JsonRenderer extends Renderer
{

	/**
	 * Render the output.
	 *
	 * @return string
	 */
	public function render(): string
	{
		return json_encode($this->data);
	}

}
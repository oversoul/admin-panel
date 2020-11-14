<?php


namespace Aecodes\AdminPanel\Responses;


class DefaultRenderer extends Renderer
{

	public function render(): array
	{
		return $this->data;
	}
}
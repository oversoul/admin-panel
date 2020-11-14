<?php

namespace Aecodes\AdminPanel;

use Aecodes\AdminPanel\Responses\Renderer;

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
	 * render widgets content.
	 * @param array $items
	 * @param array $query
	 * @return array
	 */
	final protected function renderWidgets(array $items, array $query): array
	{
		$widgets = [];

		foreach ($items as $item) {
			$widgets[] = is_string($item) ? $item : $item->build($query);
		}

		return $widgets;
	}

	/**
	 * Render layout with header and footer.
	 *
	 * @param Renderer $response
	 * @return Renderer
	 */
	final public function renderLayout(Renderer $response): Renderer
	{
		$query = $this->query();

		$response->set('layout', $this->layout);
		$response->set('menu', Dashboard::menu());
		$response->set('errors', Dashboard::errors());
		$response->set('header', $this->renderWidgets($this->bar(), $query));

		$response->set('page', [
			'name'        => $this->name,
			'description' => $this->description
		]);

		$response->set('body', $this->renderWidgets($this->render(), $query));

		return $response;
	}
}

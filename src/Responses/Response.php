<?php


namespace Aecodes\AdminPanel\Responses;

use Aecodes\AdminPanel\Panel;
use Aecodes\AdminPanel\Dashboard;
use Illuminate\Contracts\Support\Renderable;

class Response implements Renderable
{

	/** @var string */
	protected $renderer;

	/** @var Panel */
	protected $panel;

	/**
	 * Response constructor.
	 *
	 * @param Panel $panel
	 */
	public function __construct(Panel $panel)
	{
		$this->panel = $panel;
		$this->renderer = Dashboard::config('renderer');
	}

	/**
	 * @return Renderer
	 */
	public function renderer(): Renderer
	{
		$renderers = Dashboard::config('renderers', []);

		$renderer = isset($renderers[$this->renderer]) ? $renderers[$this->renderer] : DefaultRenderer::class;

		return new $renderer;
	}

	/**
	 * Render the panel using the renderer.
	 * @return mixed
	 */
	public function render()
	{
		$renderer = $this->panel->renderLayout(
			$this->renderer()
		);

		return $renderer->render();
	}

}

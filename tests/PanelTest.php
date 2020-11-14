<?php

namespace Aecodes\AdminPanel\Tests;

use Exception;
use ReflectionProperty;
use Aecodes\AdminPanel\Panel;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\Responses\Response;
use Aecodes\AdminPanel\Responses\JsonRenderer;

class PanelTest extends TestCase
{

	protected function setUp(): void
	{
		// reset the dashboard class.
		$ref = new ReflectionProperty(Dashboard::class, 'instance');
		$ref->setAccessible(true);
		$ref->setValue(null);
	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function canReturnJsonResponse()
	{
		Dashboard::setup(['renderer' => 'json', 'renderers' => ['json' => JsonRenderer::class]]);
		$panel = new class extends Panel {
			public function render(): array
			{
				return [];
			}

			public function query(): array
			{
				return [];
			}
		};

		$response = (new Response($panel))->render();
		$this->assertJson($response);
	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function canReturnArrayResponse()
	{
		Dashboard::setup(['renderer' => 'default', 'renderers' => ['json' => JsonRenderer::class]]);
		$panel = new class extends Panel {
			public $layout = 'admin';

			public function render(): array
			{
				return [];
			}

			public function query(): array
			{
				return [];
			}
		};

		$response = (new Response($panel))->render();
		$this->assertIsArray($response);
		$this->assertEquals('admin', $response['layout']);
	}
}

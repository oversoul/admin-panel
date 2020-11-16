<?php

namespace Aecodes\AdminPanel\Tests;

use Exception;
use ReflectionProperty;
use Aecodes\AdminPanel\Panel;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\Layouts\Table;
use Aecodes\AdminPanel\Responses\Response;
use Aecodes\AdminPanel\Responses\JsonRenderer;
use Aecodes\AdminPanel\Responses\DefaultRenderer;

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

	/** @test */
	public function canRenderValuesOfTable()
	{
		Dashboard::setup(['renderer' => 'default', 'renderers' => ['json' => DefaultRenderer::class]]);
		$panel = new class extends Panel {

			public function render(): array
			{
				return [
					Table::make([
						Table::column('title', 'title'),
					]),
				];
			}

			public function query(): array
			{
				return [
					['title' => 'first'],
					['title' => 'second'],
				];
			}
		};

		$response = (new Response($panel))->render();
		$this->assertIsArray($response);
		$this->assertCount(2, $response['body'][0]['rows']);
		$this->assertEquals('first', $response['body'][0]['rows'][0]['title']);
	}
}

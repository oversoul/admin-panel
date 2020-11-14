<?php

namespace Aecodes\AdminPanel\Tests;

use ReflectionProperty;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Dashboard;

class ConfigTest extends TestCase
{

	/** @throws */
	protected function setUp(): void
	{
		$config = [
			'views' => [
				'path' => 'some-testing-string',
			],
			'menu'  => [
				'/url' => 'Link 1'
			]
		];

		Dashboard::setup($config);
	}

	/** @test */
	public function canOverrideDefaultConfig()
	{
		$this->assertEquals('some-testing-string', Dashboard::config('views.path'));
	}

	/** @test */
	public function canSetGlobalMenu()
	{
		$menu = Dashboard::menu();
		$this->assertIsArray($menu);

		$this->assertArrayHasKey('/url', $menu);
		$this->assertEquals('Link 1', $menu['/url']);
	}

	/** @test */
	public function canUserDefaultConfig()
	{
		// reset the dashboard class.
		$ref = new ReflectionProperty(Dashboard::class, 'instance');
		$ref->setAccessible(true);
		$ref->setValue(null);

		Dashboard::setup();

		$this->assertEquals('default', Dashboard::config('renderer'));
	}
}

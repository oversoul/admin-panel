<?php

namespace Aecodes\AdminPanel\Tests\Layouts\Table;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Layouts\Table\TD;

class TDTest extends TestCase
{

	/** @test */
	public function canRenderHeader()
	{
		$row = (new TD('Title', 'name'))->build([]);
		$this->assertEquals('Title', $row['title']);
	}

	/** @test */
	public function canRenderValue()
	{
		$row = (new TD('Title', 'name'))->build(['name' => 'Test']);
		$this->assertEquals('Title', $row['title']);
		$this->assertEquals('Test', $row['value']);
	}

	/** @test */
	public function canHaveCustomRenderFunction()
	{
		$row = (new TD('Title', 'name'))->render(function ($data) {
			return 'hi';
		})->build(['name' => 'Test']);
		$this->assertEquals('Title', $row['title']);
		$this->assertEquals('hi', $row['value']);
	}

	/** @test */
	public function customRenderCanContainWidgets()
	{
		$row = (new TD('Title', 'name'))->render(function ($data) {
			return [
				new TD('new title'),
			];
		})->build(['name' => 'Test']);
		$this->assertEquals('Title', $row['title']);
		$this->assertIsArray($row['value']);
		$this->assertCount(1, $row['value']);
		$this->assertEquals('new title', $row['value'][0]['title']);
	}
}

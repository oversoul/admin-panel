<?php

namespace Aecodes\AdminPanel\Tests\Fields;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Widgets\Fields\Radio;

class RadioTest extends TestCase
{

	/** @test */
	public function radioCanBeCreated()
	{
		$input = Radio::make('about')->title('About')->build([]);

		$this->assertArrayHasKey('type', $input);
		$this->assertEquals('About', $input['title']);
		$this->assertEquals('Radio', $input['type']);
		$this->assertEquals('about', $input['attributes']['name']);
	}

	/** @test */
	public function radioCanHasOptions()
	{
		$input = Radio::make('about')->title('About')->options([
			1, 2, 3, 4
		])->build([]);

		$this->assertArrayHasKey('options', $input);

		foreach ([1, 2, 3, 4] as $index => $item) {
			$option = ['id' => $index, 'value' => $item, 'selected' => false];
			$this->assertEquals($input['options'][$index], $option);
		}
	}

	/** @test */
	public function radioCanHaveSelectedOption()
	{
		$input = Radio::make('about')->title('About')->options([
			1, 2, 3, 4
		])->build(['about' => 3]);

		$this->assertCount(4, $input['options']);

		foreach ([1, 2, 3, 4] as $index => $item) {
			$option = ['id' => $index, 'value' => $item, 'selected' => $item === 4];
			$this->assertEquals($input['options'][$index], $option);
		}
	}

	/** @test */
	public function canBeSetToTakeValuesAsIndexes()
	{
		$options = ['first', 'second', 'third'];

		$input = Radio::values('about')->title('About')->options($options)->build([]);

		foreach ($options as $index => $item) {
			$option = ['id' => $item, 'value' => $item, 'selected' => false];
			$this->assertEquals($input['options'][$index], $option);
		}
	}
}

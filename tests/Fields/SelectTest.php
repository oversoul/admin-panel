<?php

namespace Aecodes\AdminPanel\Tests\Fields;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Widgets\Fields\Select;

class SelectTest extends TestCase
{

	/** @test */
	public function selectCanBeCreated()
	{
		$input = Select::make('about')->title('About')->build([]);

		$this->assertArrayHasKey('type', $input);
		$this->assertEquals('About', $input['title']);
		$this->assertEquals('Select', $input['type']);
		$this->assertEquals('about', $input['attributes']['name']);
	}

	/** @test */
	public function selectCanHasOptions()
	{
		$input = Select::make('about')->title('About')->options([
			1, 2, 3, 4
		])->build([]);

		$this->assertEquals('About', $input['title']);
		$this->assertEquals('about', $input['attributes']['name']);

		$this->assertArrayHasKey('options', $input);

		foreach ([1, 2, 3, 4] as $index => $item) {
			$option = ['value' => $index, 'text' => $item, 'selected' => false];
			$this->assertEquals($input['options'][$index], $option);
		}
	}

	/** @test */
	public function selectCanHaveSelectedOption()
	{
		$input = Select::make('about')->title('About')->options([
			1, 2, 3, 4
		])->build(['about' => 3]);

		$this->assertCount(4, $input['options']);

		foreach ([1, 2, 3, 4] as $index => $item) {
			$option = ['value' => $index, 'text' => $item, 'selected' => $item === 4];
			$this->assertEquals($input['options'][$index], $option);
		}
	}

	/** @test */
	public function canBeSetToTakeValuesAsIndexes()
	{
		$options = ['first', 'second', 'third'];

		$input = Select::values('about')->title('About')->options($options)->build([]);

		foreach ($options as $index => $item) {
			$option = ['value' => $item, 'text' => $item, 'selected' => false];
			$this->assertEquals($input['options'][$index], $option);
		}
	}

}

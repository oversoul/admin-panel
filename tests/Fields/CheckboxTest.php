<?php

namespace Aecodes\AdminPanel\Tests\Fields;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Widgets\Fields\Input;
use Aecodes\AdminPanel\Widgets\Fields\Checkbox;

class CheckboxTest extends TestCase
{

    /** @test */
    public function canCreateCheckbox()
    {
        $input = Checkbox::make('checkbox')->title('About')->build([]);

        $this->assertArrayHasKey('type', $input);
        $this->assertEquals('Checkbox', $input['type']);
        $this->assertEquals('checkbox', $input['attributes']['type']);
    }

    /** @test */
    public function checkboxCanBeCreatedFromInput()
    {
        $input = Input::checkbox('checkbox')->title('About')->build([]);

        $this->assertArrayHasKey('type', $input);
        $this->assertEquals('Checkbox', $input['type']);
        $this->assertEquals('checkbox', $input['attributes']['type']);
    }

	/** @test */
	public function checkboxTesting()
	{
		$input = Input::checkbox('online')->title('Online?')->build(['online' => true]);
		$this->assertArrayHasKey('checked', $input['attributes']);

		$input = Input::checkbox('online')->title('Online?')->build(['online' => false]);
		$this->assertArrayNotHasKey('checked', $input['attributes']);
	}
}

<?php

namespace Aecodes\AdminPanel\Tests\Fields;

use Aecodes\AdminPanel\Widgets\Fields\Checkbox;
use Aecodes\AdminPanel\Widgets\Fields\Input;
use PHPUnit\Framework\TestCase;

class CheckboxTest extends TestCase
{

    /** @test */
    public function canCreateCheckbox()
    {
        $input = Checkbox::make('checkbox')->title('About')->build([]);

        $this->assertArrayHasKey('type', $input);
        $this->assertEquals('fields/input', $input['type']);
        $this->assertEquals('About', $input['title']);
        $this->assertEquals('checkbox', $input['attributes']['type']);
    }

    /** @test */
    public function checkboxCanBeCreatedFromInput()
    {
        $input = Input::checkbox('checkbox')->title('About')->build([]);

        $this->assertArrayHasKey('type', $input);
        $this->assertEquals('fields/input', $input['type']);
        $this->assertEquals('About', $input['title']);
        $this->assertEquals('checkbox', $input['attributes']['type']);
    }
}

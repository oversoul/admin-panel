<?php

namespace Aecodes\AdminPanel\Tests\Fields;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Widgets\Fields\Input;

class InputTest extends TestCase
{

    public function testInputHasDefaultTextType()
    {
        $input = Input::make('about')->title('About')->build([]);

        $this->assertArrayHasKey('type', $input);
        $this->assertEquals('fields/input', $input['type']);
        $this->assertEquals('About', $input['title']);
        $this->assertEquals('text', $input['attributes']['type']);
    }

    public function testInputTypeCanBeCustomized()
    {
        $input = Input::email('about')->build([]);
        $this->assertEquals('email', $input['attributes']['type']);

        $input = Input::number('about')->build([]);
        $this->assertEquals('number', $input['attributes']['type']);

        $this->assertEquals('about', $input['attributes']['name']);
    }

    public function testInputCanHaveAttributes()
    {
        $input = Input::text('about')->class('text-class')->build([]);

        $this->assertEquals('text', $input['attributes']['type']);
        $this->assertEquals('text-class', $input['attributes']['class']);
    }

}

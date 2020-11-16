<?php

namespace Aecodes\AdminPanel\Tests\Fields;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Widgets\Fields\Input;

class InputTest extends TestCase
{

	/** @test */
    public function inputHasDefaultTextType()
    {
        $input = Input::make('about')->title('About')->build([]);

        $this->assertArrayHasKey('type', $input);
        $this->assertEquals('Input', $input['type']);
        $this->assertEquals('About', $input['title']);
        $this->assertEquals('text', $input['attributes']['type']);
    }

    /** @test */
    public function inputTypeCanBeCustomized()
    {
        $input = Input::email('about')->build([]);
        $this->assertEquals('email', $input['attributes']['type']);

        $input = Input::number('about')->build([]);
        $this->assertEquals('number', $input['attributes']['type']);

        $this->assertEquals('about', $input['attributes']['name']);
    }

	/** @test */
	public function inputCanHaveAttributes()
    {
        $input = Input::text('about')->class('text-class')->build([]);

        $this->assertEquals('text', $input['attributes']['type']);
        $this->assertEquals('text-class', $input['attributes']['class']);
    }

	/** @test */
	public function inputCanTakeValue()
	{
		$about = 'testing str';
		$input = Input::text('about')->build(compact('about'));

		$this->assertEquals('text', $input['attributes']['type']);
		$this->assertEquals($about, $input['attributes']['value']);
	}

	/** @test */
	public function inputCanForceNoFill()
	{
		$input = Input::text('about')->noFill()->build(['about' => 'hello']);

		$this->assertEquals('text', $input['attributes']['type']);
		$this->assertEquals('', $input['attributes']['value']);
	}
}

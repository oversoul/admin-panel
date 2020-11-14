<?php

namespace Aecodes\AdminPanel\Tests\Actions;

use PHPUnit\Framework\TestCase; 
use Aecodes\AdminPanel\Widgets\Actions\Button;

class ButtonTest extends TestCase
{

    public function testButtonInstance()
    {
        $button = Button::make('About')->build([]);

        $this->assertArrayHasKey('type', $button);
        $this->assertEquals('Button', $button['type']);
        $this->assertEquals('About', $button['value']);
        $this->assertEquals('submit', $button['attributes']['type']);
    }

    public function testInvalidButtonType()
    {
        $this->expectException(\Exception::class);
        Button::make('About')->type('non-valid-type')->build([]);
    }

    public function testValidButtonType()
    {
        $button = Button::make('About')->type('reset')->build([]);
        $this->assertEquals('reset', $button['attributes']['type']);
    }

    public function testCanHaveAttributes()
    {
        $button = Button::make('About')->class('btn btn-primary')->build([]);
        $this->assertEquals("btn btn-primary", $button['attributes']['class']);
    }
}
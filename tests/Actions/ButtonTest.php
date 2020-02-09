<?php

namespace Aecodes\Tests\Actions;

use PHPUnit\Framework\TestCase; 
use Aecodes\AdminPanel\Actions\Button;

class ButtonTest extends TestCase
{

    /**
     * @test
     */
    public function testButtonInstance()
    {
        $button = Button::make('About')->build();

        $this->assertStringContainsString(
            'type="submit"',
            $button
        );

        $this->assertStringContainsString(
            'About',
            $button
        );
    }

    public function testInvalidButtonType()
    {
        $this->expectException(\Exception::class);
        Button::make('About')->type('non-valid-type')->build();
    }

    public function testValidButtonType()
    {
        $button = Button::make('About')->type('reset')->build();
        $this->assertStringContainsString(
            'type="reset"',
            $button
        );

        $this->assertStringContainsString(
            'About',
            $button
        );
    }

    public function testCanHaveAttributes()
    {
        $button = Button::make('About')->class('btn btn-primary')->build();
        $this->assertStringContainsString(
            'class="btn btn-primary"',
            $button
        );
    }
}
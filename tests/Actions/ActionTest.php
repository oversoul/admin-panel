<?php

namespace Aecodes\AdminPanel\Tests\Actions;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Widgets\Actions\Link;
use Aecodes\AdminPanel\Widgets\Actions\Action;
use Aecodes\AdminPanel\Widgets\Actions\Button;

class ActionTest extends TestCase
{

	/** @test */
    public function canProvideButtonInstance()
    {
        $button = Action::button('About');
        $this->assertInstanceOf(Button::class, $button);

        $button = $button->build([]);

        $this->assertArrayHasKey('type', $button);
        $this->assertEquals('About', $button['value']);
        $this->assertEquals('submit', $button['attributes']['type']);
    }

    public function testCanProvideLinkInstance()
    {
        $link = Action::link('About');
        $this->assertInstanceOf(Link::class, $link);

        $link = $link->build([]);

        $this->assertArrayHasKey('type', $link);
        $this->assertEquals('About', $link['value']);
        $this->assertEquals('', $link['attributes']['href']);
    }

    public function testActionInvalidButtonType()
    {
        $this->expectException(\Exception::class);
        Action::button('About')->type('non-valid-type')->build([]);
    }

    public function testActionValidButtonType()
    {
        $button = Action::button('About')->type('reset')->build([]);
        $this->assertEquals('reset', $button['attributes']['type']);
    }

    public function testValidLinkUrl()
    {
        $url  = 'https://google.com';
        $link = Action::link('About')->href($url)->build([]);

        $this->assertEquals('About', $link['value']);
        $this->assertEquals($link['attributes']['href'], $url);
    }

    public function testInvalidActionType()
    {
        $this->expectException(\Exception::class);
        Action::something('About')->href($url)->build([]);
    }
}

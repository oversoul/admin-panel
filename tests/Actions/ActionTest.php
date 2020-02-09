<?php

namespace Aecodes\Tests\Actions;

use PHPUnit\Framework\TestCase; 
use Aecodes\AdminPanel\Actions\Link;
use Aecodes\AdminPanel\Actions\Action;
use Aecodes\AdminPanel\Actions\Button;

class ActionTest extends TestCase
{

    public function testCanProvideButtonInstance()
    {
        $button = Action::button('About');
        $this->assertInstanceOf(Button::class, $button);
        $this->assertStringContainsString('type="submit"', $button);
        $this->assertStringContainsString('About', $button);
    }

    public function testCanProvideLinkInstance()
    {
        $link = Action::link('About');
        $this->assertInstanceOf(Link::class, $link);
        $this->assertStringContainsString('href=""', $link);
        $this->assertStringContainsString('About', $link);
    }

    public function testActionInvalidButtonType()
    {
        $this->expectException(\Exception::class);
        Action::button('About')->type('non-valid-type')->build();
    }

    public function testActionValidButtonType()
    {
        $button = Action::button('About')->type('reset')->build();
        $this->assertStringContainsString('type="reset"', $button);
        $this->assertStringContainsString('About', $button);
    }

    public function testValidLinkUrl()
    {
        $url  = 'https://google.com';
        $link = Action::link('About')->href($url)->build();
        $this->assertStringContainsString($url, $link);
        $this->assertStringContainsString('About', $link);
    }
}
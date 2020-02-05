<?php

namespace Aecodes\Tests\Actions;

use PHPUnit\Framework\TestCase; 
use Aecodes\AdminPanel\AdminConfig;
use Aecodes\AdminPanel\Actions\Link;

class LinkTest extends TestCase
{

    public function testLinkInstance()
    {
        $link = Link::make('About')->build();
        $this->assertStringContainsString('href=""', $link);
        $this->assertStringContainsString('About', $link);
    }

    public function testValidLinkUrl()
    {
        $url  = 'https://google.com';
        $link = Link::make('About')->href($url)->build();
        $this->assertStringContainsString($url, $link);
        $this->assertStringContainsString('About', $link);
    }

    public function testValidLinkUrlAlias()
    {
        $url  = 'https://google.com';
        $link = Link::make('About')->url($url)->build();
        $this->assertStringContainsString($url, $link);
        $this->assertStringContainsString('About', $link);
    }

    public function testCanHaveAttributes()
    {
        $link = Link::make('About')->class('btn btn-primary')->build();
        $this->assertStringContainsString('class="btn btn-primary"', $link);
    }
}
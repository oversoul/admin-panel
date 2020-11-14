<?php

namespace Aecodes\AdminPanel\Tests\Actions;

use PHPUnit\Framework\TestCase; 
use Aecodes\AdminPanel\Widgets\Actions\Link;

class LinkTest extends TestCase
{

    public function testLinkInstance()
    {
        $link = Link::make('About')->build([]);

        $this->assertArrayHasKey('type', $link);
        $this->assertArrayHasKey('attributes', $link);
        $this->assertEquals('Link', $link['type']);
        $this->assertEquals('About', $link['value']);
        $this->assertEquals('', $link['attributes']['href']);
    }

    public function testValidLinkUrl()
    {
        $url  = 'https://google.com';
        $link = Link::make('About')->href($url)->build([]);
        $this->assertEquals($link['attributes']['href'], $url); 
    }

    public function testValidLinkUrlAlias()
    {
        $url  = 'https://google.com';
        $link = Link::make('About')->url($url)->build([]);
        $this->assertEquals($link['attributes']['href'], $url); 
    }

    public function testCanHaveAttributes()
    {
        $link = Link::make('About')->class('btn btn-primary')->build([]);
        $this->assertEquals("btn btn-primary", $link['attributes']['class']);
    }
}
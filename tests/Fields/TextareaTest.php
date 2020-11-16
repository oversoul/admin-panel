<?php

namespace Aecodes\AdminPanel\Tests\Fields;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Widgets\Fields\Textarea;

class TextareaTest extends TestCase
{

    /** @test */
    public function canCreateTextarea()
    {
        $textarea = Textarea::make('about')->title('About')->build([]);

        $this->assertArrayHasKey('type', $textarea);
        $this->assertEquals('About', $textarea['title']);
        $this->assertEquals('Textarea', $textarea['type']);
        $this->assertArrayNotHasKey('type', $textarea['attributes']);
    }

    /** @test */
    public function hasDefaultRows()
    {
        $textarea = Textarea::make('about')->title('About')->build([]);
        $this->assertEquals(3, $textarea['attributes']['rows']);

        $textarea = Textarea::make('about')->rows(5)->title('About')->build([]);
        $this->assertEquals(5, $textarea['attributes']['rows']);
    }

}

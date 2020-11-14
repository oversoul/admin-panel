<?php
namespace Aecodes\AdminPanel\Tests\Layouts;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Layouts\Div;

class DivTest extends TestCase
{

    /** @test */
    public function canRenderEmptyDiv()
    {
        $div = Div::make([])->build([]);
        $this->assertArrayHasKey('type', $div);
        $this->assertEquals('Div', $div['type']);
    }

    /** @test */
    public function canRenderDivWithClass()
    {
        $div = Div::make([])->class('form-group')->build([]);
        $this->assertEquals('form-group', $div['attributes']['class']);
    }

    /** @test */
    public function canRenderChainedDivsWithClass()
    {
        $div = Div::make([
            Div::make([])->class('sub-div'),
        ])->class('form-group')->build([]);

        $this->assertCount(1, $div['value']);
        $this->assertEquals('form-group', $div['attributes']['class']);
        $this->assertEquals('Div', $div['value'][0]['type']);
        $this->assertEquals('sub-div', $div['value'][0]['attributes']['class']);
    }

}

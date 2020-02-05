<?php

namespace Aecodes\Tests;

use Aecodes\AdminPanel\Layouts\Table\TD;
use PHPUnit\Framework\TestCase;

class TDTest extends TestCase
{

    public function testCanRenderTh()
    {
        $td = new TD('name', 'Title');
        $th = $td->renderTitle();

        $this->assertStringContainsString($th, '<th>Title</th>');
    }

    public function testCanRenderTdAsObject()
    {
        $td = new TD('name', 'Title');
        $data = new class
        {
            public $name = 'AdminPanel';
        };

        $td = $td->renderValue($data);
        $this->assertStringContainsString($td, '<td>AdminPanel</td>');
    }

    public function testCanRenderTdAsArray()
    {
        $td = new TD('name', 'Title');
        $data = ['name' => 'AdminPanel'];

        $td = $td->renderValue($data);
        $this->assertStringContainsString($td, '<td>AdminPanel</td>');
    }

    public function testCustomRenderer()
    {
        $td = (new TD('name', 'Title'))->render(function ($row) {
            return 'custom-value';
        });

        $data = new class
        {
            public $name = 'AdminPanel';
        };

        $td = $td->renderValue($data);
        $this->assertStringContainsString($td, '<td>custom-value</td>');
    }

}

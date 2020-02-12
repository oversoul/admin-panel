<?php
namespace Aecodes\Tests;

use Aecodes\AdminPanel\View;
use Aecodes\AdminPanel\Panel;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Accessor;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\AdminConfig;
use Aecodes\AdminPanel\Layouts\Div;
use Aecodes\AdminPanel\Fields\Input;
use Aecodes\AdminPanel\Layouts\Form;

class DivTest extends TestCase
{

    protected $config;
    protected $dashboard;

    public function setUp(): void
    {
        Dashboard::stop();
        $this->config = new class extends AdminConfig
        {};
        $this->dashboard = Dashboard::make($this->config);
    }

    public function testCanRenderEmptyDiv()
    {
        $view = new View;
        $div = Div::make([])->build([], $view);
        $this->assertStringContainsString('<div ></div>', $div);
    }

    public function testCanRenderEmptyDivWithClass()
    {
        $view = new View;
        $div = Div::make([])->class('form-group')->build([], $view);
        $this->assertStringContainsString('<div class="form-group"></div>', $div);
    }

    public function testCanRenderChainedDivsWithClass()
    {
        $view = new View;
        $div = Div::make([
            Div::make([])->class('sub-div'),
        ])->class('form-group')->build([], $view);
        $this->assertStringContainsString('<div class="form-group">', $div);
        $this->assertStringContainsString('<div class="form-group"><div class="sub-div"', $div);
    }

}

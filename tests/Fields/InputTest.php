<?php

namespace Aecodes\Tests\Fields;

use Aecodes\AdminPanel\View;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\AdminConfig;
use Aecodes\AdminPanel\Fields\Input;

class InputTest extends TestCase
{

    protected $view;

    public function setUp(): void
    {
        $config = new class extends AdminConfig {};

        Dashboard::make($config);

        $this->view = new View;
        $this->view->page = new class {};
    }

    public function testInputHasDefaultTextType()
    {
        $input = Input::make('about')->build([], $this->view);

        $this->assertStringContainsString('type="text"', $input);
        $this->assertStringContainsString('about', $input);
    }

    public function testInputTypeCanBeCustomized()
    {
        $input = Input::email('about')->build([], $this->view);

        $this->assertStringContainsString('type="email"', $input);
        $this->assertStringContainsString('about', $input);
    }

    public function testInputTypeCanBeNumber()
    {
        $input = Input::number('about')->build([], $this->view);

        $this->assertStringContainsString('type="number"', $input);
        $this->assertStringContainsString('about', $input);
    }

    public function testInputCanHaveAttributes()
    {
        $input = Input::text('about')
            ->class('text-class')
            ->build([], $this->view);

        $this->assertStringContainsString('type="text"', $input);
        $this->assertStringContainsString('class="text-class"', $input);
        $this->assertStringContainsString('about', $input);
    }

}

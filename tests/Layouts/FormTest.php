<?php
namespace Aecodes\Tests;

use Aecodes\AdminPanel\View;
use Aecodes\AdminPanel\Panel;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Accessor;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\AdminConfig;
use Aecodes\AdminPanel\Fields\Input;
use Aecodes\AdminPanel\Layouts\Form;

class FormTest extends TestCase
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

    public function testCantRenderEmptyForm()
    {
        $panel = (string) new class extends Panel
        {
            function query(): array
            {
                return [];
            }

            function render(): array
            {
                return [
                    Form::make([

                    ])
                ];
            }
        };

        $this->assertStringContainsString('At least one form item needs to be defined', $panel);
    }

    public function testCanRenderFormInputs()
    {
        $panel = (string) new class extends Panel
        {
            function query(): array
            {
                return [];
            }

            function render(): array
            {
                return [
                    Form::make([
                        Input::make('email')->title('Email'),
                    ]),
                ];
            }
        };

        $this->assertStringContainsString('<form', $panel);
        $this->assertStringContainsString('<input', $panel);
        $this->assertStringContainsString('value=""', $panel);
    }

    public function testCanRenderFormWithInputValues()
    {
        $panel = (string) new class extends Panel
        {
            function query(): array
            {
                return [
                    'email' =>  'john@example.com'
                ];
            }

            function render(): array
            {
                return [
                    Form::make([
                        Input::make('email')->title('Email'),
                    ]),
                ];
            }
        };

        $this->assertStringContainsString('<form', $panel);
        $this->assertStringContainsString('<input', $panel);
        $this->assertStringContainsString('value="john@example.com"', $panel);
    }

    public function testFormCanHaveDifferentMethods()
    {
        $view = new View;
        $view->topBar = [];

        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->build([], $view);

        $this->assertStringContainsString('Email', $form);
        $this->assertStringContainsString('method="POST"', $form);

        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->method('PUT')->build([], $view);

        $this->assertStringContainsString('method="POST"', $form);
        $this->assertStringContainsString('name="_method"', $form);
        $this->assertStringContainsString('value="PUT"', $form);

        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->method('DELETE')->build([], $view);

        $this->assertStringContainsString('method="POST"', $form);
        $this->assertStringContainsString('name="_method"', $form);
        $this->assertStringContainsString('value="DELETE"', $form);

        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->method('GET')->build([], $view);

        $this->assertStringContainsString('method="GET"', $form);
    }

    public function testFormCanHaveAction()
    {
        $view = new View;
        $view->topBar = [];
        
        $action = \random_bytes(20);
        
        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->action($action)->build([], $view);

        $this->assertStringContainsString('Email', $form);
        $this->assertStringContainsString('action="' . $action . '"', $form);
    }
}

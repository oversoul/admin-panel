<?php
namespace Aecodes\AdminPanel\Tests\Layouts;

use Exception;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Widgets\Fields\Input;
use Aecodes\AdminPanel\Layouts\Form;

class FormTest extends TestCase
{

    /** @test */
    public function canRenderFormInputs()
    {
        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->build([]);

        $this->assertArrayHasKey('type', $form);
        $this->assertCount(1, $form['fields']);
        $this->assertEquals('Form', $form['type']);
        $this->assertEquals('Input', $form['fields'][0]['type']);
    }

    /** @test */
    public function canRenderFormWithInputValues()
    {
        $email = 'john@example.com';

        $form = form::make([
            Input::make('email')->title('email')->value($email),
        ])->build([]);

        $this->assertequals($form['fields'][0]['attributes']['value'], $email);

        $form = form::make([
            Input::make('email')->title('email')
        ])->build(compact('email'));

        $this->assertequals($form['fields'][0]['attributes']['value'], $email);
    }

    /** @test */
    public function formCanHaveDifferentMethods()
    {
        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->build([]);

        $this->assertEquals('POST', $form['attributes']['method']);

        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->method('PUT')->build([]);

        $this->assertCount(2, $form['fields']);
        $this->assertEquals('POST', $form['attributes']['method']);
        $this->assertEquals('_method', $form['fields'][0]['attributes']['name']);
        $this->assertEquals('PUT', $form['fields'][0]['attributes']['value']);

        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->method('DELETE')->build([]);

        $this->assertEquals('POST', $form['attributes']['method']);
        $this->assertEquals('_method', $form['fields'][0]['attributes']['name']);
        $this->assertEquals('DELETE', $form['fields'][0]['attributes']['value']);
    }

	/** @test
	 * @throws Exception
	 */
    public function formCanHaveAction()
    {
        $action = random_bytes(20);
        
        $form = Form::make([
            Input::make('email')->title('Email'),
        ])->action($action)->build([]);

        $this->assertEquals($form['attributes']['action'], $action);
    }
}

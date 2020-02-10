<?php

namespace Aecodes\Tests\Fields;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Accessor;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\AdminConfig;
use Aecodes\AdminPanel\Layouts\View;
use Aecodes\AdminPanel\Fields\Select;

class SelectTest extends TestCase
{

    protected $view;

    public function setUp(): void
    {
        $config = new class extends AdminConfig {};

        Dashboard::make($config);

        $this->view = new View;
        $this->view->page = new Accessor;
    }

    public function testSelectCanBeCreated()
    {
        $input = Select::make('about')->title('About')->build([], $this->view);

        $this->assertStringContainsString('about', $input);
        $this->assertStringContainsString('About', $input);
    }

    public function testSelectCanHasOptions()
    {
        $input = Select::make('about')->title('About')->options([
            1, 2, 3, 4
        ])->build([], $this->view);

        $this->assertStringContainsString('about', $input);
        $this->assertStringContainsString('About', $input);
        $this->assertStringContainsString(1, $input);
        $this->assertStringContainsString(2, $input);
        $this->assertStringContainsString(3, $input);
        $this->assertStringContainsString(4, $input);
    }

    public function testSelectCanHaveSelectedOption()
    {
        $input = Select::make('about')->title('About')->options([
            1, 2, 3, 4
        ])->build(['about' => 3], $this->view);

        $this->assertStringContainsString('selected>4', $input);
    }

}

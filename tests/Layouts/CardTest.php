<?php
namespace Aecodes\Tests;

use Aecodes\AdminPanel\View;
use Aecodes\AdminPanel\Panel;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Accessor;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\AdminConfig;
use Aecodes\AdminPanel\Layouts\Card;

class CardTest extends TestCase
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

    public function testCanRenderSimpleCard()
    {
        $view = new View;
        $card = Card::make('Title', 'Some content')->build([], $view);
        $this->assertStringContainsString('Title', $card);
        $this->assertStringContainsString('Some content', $card);
    }

    public function testCardCanHaveClasses()
    {
        $view = new View;
        $card = Card::make('Title', 'Some content')->class('form-card')->build([], $view);
        $this->assertStringContainsString('Title', $card);
        $this->assertStringContainsString('Some content', $card);
        $this->assertStringContainsString('class="form-card"', $card);
    }
}

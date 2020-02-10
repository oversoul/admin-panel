<?php
namespace Aecodes\Tests;

use Aecodes\AdminPanel\Panel;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\AdminConfig;
use Aecodes\AdminPanel\Layouts\Table;
use Aecodes\AdminPanel\Layouts\Table\TD;

class PanelTest extends TestCase
{
    protected static $config;
    protected static $dashboard;

    public function setUp(): void
    {
        self::$config = new class extends AdminConfig {
            function menu(): array {
                return [
                    ['name' => 'Menu 1', 'url' => '/menu-1'],
                    ['name' => 'Menu 2', 'url' => '/menu-2'],
                    ['name' => 'Menu 3', 'url' => '/menu-3'],
                    ['name' => 'Menu 4', 'url' => '/menu-4'],
                ];
            }
        };

        Dashboard::stop();

        self::$dashboard  = Dashboard::make(self::$config);

        $this->panel = new class extends Panel
        {

            public function query(): array
            {
                return [];
            }

            public function render(): array
            {
                return [];
            }
        };
    }

    public function testCanHaveEmptyPanel()
    {
        $this->assertInstanceOf(Panel::class, $this->panel);
    }

    public function testCanRenderEmptyPanelView()
    {
        $this->assertStringContainsString('Admin Panel', $this->panel);
    }

    public function testCanHaveMenuItems()
    {
        $this->assertStringContainsString('Menu 1', $this->panel);
        $this->assertStringContainsString('href="/menu-1"', $this->panel);
        $this->assertStringContainsString('Menu 2', $this->panel);
        $this->assertStringContainsString('href="/menu-2"', $this->panel);
        $this->assertStringContainsString('Menu 3', $this->panel);
        $this->assertStringContainsString('href="/menu-3"', $this->panel);
        $this->assertStringContainsString('Menu 4', $this->panel);
        $this->assertStringContainsString('href="/menu-4"', $this->panel);
    }
}

<?php
namespace Aecodes\Tests;

use Aecodes\AdminPanel\Panel;
use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\AdminConfig;
use Aecodes\AdminPanel\Layouts\Table;
use Aecodes\AdminPanel\Layouts\Table\TD;

class TableTest extends TestCase {
    
    protected $config;
    protected $dashboard;

    public function setUp(): void
    {
        Dashboard::stop();
        $this->config = new class extends AdminConfig {};
        $this->dashboard  = Dashboard::make($this->config);
    }

    public function testCanRenderTableWithEmptyRows()
    {
        $panel = (string) new class extends Panel {
            function query(): array {
                return [];
            }

            function render(): array {
                return [
                    Table::make([
                        TD::make('id', '#'),
                        TD::make('title', 'Title'),
                    ])
                ];
            }
        };

        $this->assertStringContainsString('#', $panel);
        $this->assertStringContainsString('title', $panel);
        $this->assertStringContainsString('No rows found', $panel);
    }

    public function testCanRenderTableWithEmptyRowsUsingColumnInsteadOfTD()
    {
        $panel = (string) new class extends Panel {
            function query(): array {
                return [];
            }

            function render(): array {
                return [
                    Table::make([
                        Table::column('id', '#'),
                        Table::column('title', 'Title'),
                    ])
                ];
            }
        };

        $this->assertStringContainsString('#', $panel);
        $this->assertStringContainsString('title', $panel);
        $this->assertStringContainsString('No rows found', $panel);
    }

    public function testCanRenderTableData()
    {
        $panel = (string) new class extends Panel {
            function query(): array {
                return [
                    ['id' => 1, 'title' => 'Title 1'],
                    ['id' => 2, 'title' => 'Title 2'],
                    ['id' => 3, 'title' => 'Title 3'],
                ];
            }

            function render(): array {
                return [
                    Table::make([
                        TD::make('id', '#'),
                        TD::make('title', 'Title'),
                    ])
                ];
            }
        };

        $this->assertStringContainsString('#', $panel);
        $this->assertStringContainsString('title', $panel);
        $this->assertStringContainsString('>1</td>', $panel);
        $this->assertStringContainsString('>2</td>', $panel);
        $this->assertStringContainsString('>3</td>', $panel);

        $this->assertStringContainsString('>Title 1</td>', $panel);
        $this->assertStringContainsString('>Title 2</td>', $panel);
        $this->assertStringContainsString('>Title 3</td>', $panel);
    }

    public function testTableCanHaveFooter()
    {
        $panel = (string) new class extends Panel {
            function query(): array {
                return [];
            }

            function render(): array {
                return [
                    Table::make([
                        TD::make('id', '#'),
                        TD::make('title', 'Title'),
                    ])->footer([
                        'Hello world 1',
                        'Hello world 2',
                    ])
                ];
            }
        };

        $this->assertStringContainsString('Hello world 1', $panel);
        $this->assertStringContainsString('Hello world 2', $panel);
    }
}
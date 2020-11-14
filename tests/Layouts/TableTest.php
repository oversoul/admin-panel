<?php
namespace Aecodes\AdminPanel\Tests\Layouts;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Layouts\Table;
use Aecodes\AdminPanel\Layouts\Table\TD;

class TableTest extends TestCase {

    
    /** @test */
    public function canRenderTableWithEmptyRows()
    {
        $table = Table::make([
            TD::make('#', 'id'),
            TD::make('Title', 'title'),
        ])->build([]);

        $this->assertCount(0, $table['rows']);
        $this->assertCount(2, $table['headers']);
    }

    /** @test */
    public function canRenderTableRowsUsingColumnInsteadOfTD()
    {
        $table = Table::make([
            Table::column('id', '#'),
            Table::column('title', 'Title'),
        ])->build([]);

        $this->assertCount(0, $table['rows']);
        $this->assertCount(2, $table['headers']);
    }

    /** @test */
    public function canRenderTableData()
    {
        $rows = [
            ['id' => 1, 'title' => 'Title 1'],
            ['id' => 2, 'title' => 'Title 2'],
            ['id' => 3, 'title' => 'Title 3'],
        ];

        $table = Table::make([
            TD::make('id', '#'),
            TD::make('title', 'Title'),
        ])->build($rows);

        $this->assertCount(3, $table['rows']);
        $this->assertCount(2, $table['headers']);

        foreach ($rows as $index => $row) {
            $this->assertEquals($row['title'], $table['rows'][$index]['title']);
        }
    }

    /** @test */
    public function tableCanHaveFooter()
    {
        $table = Table::make([
            TD::make('id', '#'),
            TD::make('title', 'Title'),
        ])->footer([ 'Hello world 1', 'Hello world 2' ])->build([]);

        $this->assertCount(0, $table['rows']);
        $this->assertCount(2, $table['headers']);
        $this->assertCount(2, $table['footer']);
        $this->assertEquals('Hello world 1', $table['footer'][0]);
    }
}
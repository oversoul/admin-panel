<?php

namespace Aecodes\AdminPanel\Tests\Layouts\Table;

use PHPUnit\Framework\TestCase;
use Aecodes\AdminPanel\Layouts\Table\TD;

class TDTest extends TestCase
{

    /** @test */
    public function canRenderHeader()
    {
        $table = (new TD('Title', 'name'))->build([]);
        $this->assertEquals('Title', $table['value']);
    }

}

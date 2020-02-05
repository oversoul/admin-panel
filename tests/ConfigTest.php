<?php

namespace Aecodes\Tests;

use PHPUnit\Framework\TestCase; 
use Aecodes\AdminPanel\AdminConfig;

class ConfigTest extends TestCase
{

    public function testCantCreateInstanceOfConfig()
    {
        $this->expectException(\Error::class);
        new AdminConfig;
    }

    public function testCanCustomizeViewsPath()
    {
        $config = new class extends AdminConfig {
            
            public function viewsPath(): string
            {
                return 'some-testing-string';
            }
        };

        $this->assertEquals($config->viewsPath(), 'some-testing-string');
    }
}
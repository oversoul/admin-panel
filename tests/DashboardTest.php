<?php

namespace Aecodes\Tests;

use PHPUnit\Framework\TestCase; 
use Aecodes\AdminPanel\Dashboard;
use Aecodes\AdminPanel\AdminConfig;

/**
 * Class DashboardTest.
 */
class DashboardTest extends TestCase
{

    public function testShouldBeCreatedFromMake()
    {
        $config = new class extends AdminConfig {};

        $this->assertInstanceOf(
            Dashboard::class,
            Dashboard::make($config),
        );

        $this->assertEquals(Dashboard::config(), $config);
    }

    public function testShouldNotBeInstanciatedDirectly()
    {
        $config = new class extends AdminConfig {};

        $this->expectException(\Error::class);

        new Dashboard($config);
    }

}
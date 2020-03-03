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

    protected $config;
    protected $dashboard;

    public function setUp(): void
    {
        Dashboard::stop();
        $this->config = new class extends AdminConfig {};
        $this->dashboard  = Dashboard::make($this->config);
    }

    public function testShouldBeCreatedFromMake()
    {
        $this->assertInstanceOf(
            Dashboard::class,
            $this->dashboard
        );

        $this->assertEquals($this->dashboard::config(), $this->config);
    }

    public function testShouldNotBeInstanciatedDirectly()
    {
        $config = new class extends AdminConfig {};
        $this->expectException(\Error::class);
        new Dashboard($config);
    }

}
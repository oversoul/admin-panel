<?php

namespace Aecodes\Tests;

use PHPUnit\Framework\TestCase; 
use Aecodes\AdminPanel\Accessor;

class AccessorTest extends TestCase
{

    public function testCanGetSingleKey()
    {
        $data = ['name' => 'AdminPanel'];
        $accessor = new Accessor($data);

        $this->assertEquals($accessor->get('name'), 'AdminPanel');
    }

    public function testCanGetDottedKey()
    {
        $data = ['app' => ['name' => 'AdminPanel']];
        
        $accessor = new Accessor($data);
        $this->assertEquals($accessor->get('app.name'), 'AdminPanel');
    }


    public function testCanCheckIfSingleKeyExists()
    {
        $data = ['name' => 'AdminPanel'];
        $accessor = new Accessor($data);

        $this->assertEquals($accessor->has('name'), true);
        $this->assertEquals($accessor->has('some-other-key'), false);
    }

    public function testCanCheckIfDottedKeyExists()
    {
        $data = ['app' => ['name' => 'AdminPanel']];
        
        $accessor = new Accessor($data);
        $this->assertEquals($accessor->has('app.name'), true);
        $this->assertEquals($accessor->has('some.other'), false);
    }
}
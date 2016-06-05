<?php

use \Mockery as m;

class AdapterTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        // copy(__DIR__.'/stub_file.txt', __DIR__.'/file.txt');
    }

    public function tearDown()
    {
        m::close();
    }

    public function testClassCreate()
    {
        $adapter = new StaticSites\Filesystem\Adapters\Adapter();
        $this->assertInstanceOf('StaticSites\Filesystem\Adapters\Adapter', $adapter);
    }
}

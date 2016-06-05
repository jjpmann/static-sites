<?php

use \Mockery as m;

class SftpAdapterTest extends \PHPUnit_Framework_TestCase
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
        $adapter = new StaticSites\Filesystem\Adapters\SftpAdapter();
        $this->assertInstanceOf('StaticSites\Filesystem\Adapters\SftpAdapter', $adapter);
    }
}

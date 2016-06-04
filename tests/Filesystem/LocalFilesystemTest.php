<?php

use \Mockery as m;

class LocalFileSystem#Test extends BaseFileSystemTest
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
        $fs = new StaticSites\Filesystem\LocalFileSystem($this->mockConfig());
        $this->assertInstanceOf('StaticSites\Filesystem\LocalFileSystem', $fs);
    }

    public function testLocalAdapter()
    {
        $fs = new StaticSites\Filesystem\LocalFileSystem($this->mockConfig());
        $this->assertInstanceOf('League\Flysystem\Adapter\Local', $fs->getAdapter());   
    }

}

<?php

use \Mockery as m;

class LocalFilesystemTest extends BaseFilesystemTest
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
        $fs = new StaticSites\Filesystem\LocalFileystem($this->mockConfig());
        $this->assertInstanceOf('StaticSites\Filesystem\LocalFilesystem', $fs);
    }

    public function testLocalAdapter()
    {
        $fs = new StaticSites\Filesystem\LocalFilesystem($this->mockConfig());
        $this->assertInstanceOf('League\Flysystem\Adapter\Local', $fs->getAdapter());
    }
}

<?php

use \Mockery as m;

class RemoteFilesystemTest extends BaseFileSystemTest
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
        $fs = new StaticSites\Filesystem\RemoteFileSystem($this->mockConfig());
        $this->assertInstanceOf('StaticSites\Filesystem\RemoteFileSystem', $fs);
    }

    public function testS3AdapterException()
    {
        $options['remote'] = [
            'type' => 's3',
        ];
        $fs = new StaticSites\Filesystem\RemoteFileSystem($this->mockConfig($options));

        $this->setExpectedException('StaticSites\Filesystem\Adapters\AdapterException');
        $fs->getAdapter();
    }

    public function testS3Adapter()
    {
        $options['remote'] = [
            'type'    => 's3',
            'key'     => 'xxx',
            'secret'  => 'xxxx',
            'region'  => 'xxx',
            'version' => 'latest',
            'bucket'  => 'xxxx',
        ];
        $fs = new StaticSites\Filesystem\RemoteFileSystem($this->mockConfig($options));
        $this->assertInstanceOf('League\Flysystem\AwsS3v3\AwsS3Adapter', $fs->getAdapter());
    }

    public function testFtpAdapterException()
    {
        $options['remote'] = [
            'type' => 'ftp',
        ];

        $fs = new StaticSites\Filesystem\RemoteFileSystem($this->mockConfig($options));
        $this->setExpectedException('StaticSites\Filesystem\Adapters\AdapterException');
        $fs->getAdapter();
    }

    public function testFtpAdapter()
    {
        $options['remote'] = [
            'type'     => 'ftp',
            'host'     => 'xxx.com',
            'username' => 'name',
            'password' => 'xxx',
        ];
        $fs = new StaticSites\Filesystem\RemoteFileSystem($this->mockConfig($options));
        $this->assertInstanceOf('League\Flysystem\Adapter\Ftp', $fs->getAdapter());
    }

    public function testSftpAdapterException()
    {
        $options['remote'] = [
            'type' => 'sftp',
        ];
        $fs = new StaticSites\Filesystem\RemoteFileSystem($this->mockConfig($options));
        $this->setExpectedException('StaticSites\Filesystem\Adapters\AdapterException');
        $fs->getAdapter();
    }

    public function testSftpAdapter()
    {
        $options['remote'] = [
            'type'     => 'sftp',
            'host'     => 'xxx.com',
            'username' => 'name',
            'password' => 'xxx',
        ];
        $fs = new StaticSites\Filesystem\RemoteFileSystem($this->mockConfig($options));
        $this->assertInstanceOf('League\Flysystem\Sftp\SftpAdapter', $fs->getAdapter());
    }
}

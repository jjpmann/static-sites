<?php

use \Mockery as m;

class ScraperTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        // copy(__DIR__.'/stub_file.txt', __DIR__.'/file.txt');
    }

    public function tearDown()
    {
        m::close();
    }

    protected function mockConfig($options = [])
    {
        $list = isset($options['list']) ? $options['list'] : ['one', 'two', ' three'];
        $location = isset($options['location']) ? $options['location'] : '.';
        $site = isset($options['site']) ? $options['site'] : ['local' => 'www.example.com', 'remote' => 'remote.example.com'];

        $config = m::mock('Illuminate\Config\Repository');
        // /$config->shouldReceive('get')->times(3);
        $config->fsLocal = m::mock('League\Flysystem\Filesystem');
        $config->fsRemote = m::mock('League\Flysystem\Filesystem');
        $config->list = $list;
        $config->location = $location;
        $config->site = $site;

        return $config;
    }

    public function testClassCreate()
    {
        $config = $this->mockConfig();
        $scraper = new StaticSites\Sraper\Scraper($config);
        $this->assertInstanceOf('StaticSites\Sraper\Scraper', $scraper);
    }

    public function testListCollection()
    {
        $config = $this->mockConfig();
        $scraper = new StaticSites\Sraper\Scraper($config);
        $this->assertInstanceOf('Illuminate\Support\Collection', $scraper->getList());
        $list = collect($config->list);
        $this->assertEquals($list, $scraper->getList());
    }

    public function testLocation()
    {
        $config = $this->mockConfig(['site' => ['local' => 'http://www1.example.com', 'remote' => 'http://www2.example.com']]);
        $scraper = new StaticSites\Sraper\Scraper($config);

        $this->assertEquals('http://www1.example.com', $scraper->getLocalSite());
        $this->assertEquals('http://www2.example.com', $scraper->getRemoteSite());
    }

    public function testGetPage()
    {
        $config = $this->mockConfig(['location' => '.', 'site' => ['local' => 'http://example.com', 'remote' => '']]);
        $scraper = new StaticSites\Sraper\Scraper($config);


        $this->assertEquals($scraper->getPage('http://example.com'), 'index.html');
        $this->assertEquals($scraper->getPage('http://example.com/about'), 'about/index.html');
        $this->assertEquals($scraper->getPage('http://example.com/blog'), 'blog/index.html');
    }

    public function testWritePage()
    {
    }

    public function testScrape()
    {
    }
}

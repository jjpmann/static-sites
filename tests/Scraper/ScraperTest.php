<?php

use \Mockery as m;

class Scraper extends \PHPUnit_Framework_TestCase
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
        $list = isset($options['list']) ? $options['list'] : ['one', 'two',' three'];
        $location = isset($options['location']) ? $options['location'] : '.';
        $site = isset($options['site']) ? $options['site'] : 'www.example.com';

        $config = m::mock('Illuminate\Config\Repository');
        $config->list       = $list;
        $config->location   = $location;
        $config->site       = $site;
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
        $site = 'http://www.example.com';
        $config = $this->mockConfig(['site'=>$site]);
        $scraper = new StaticSites\Sraper\Scraper($config);

        $this->assertEquals($site, $scraper->getSite());
        
    }

    public function testGetPage()
    {
        $config = $this->mockConfig(['location' => '.', 'site' => 'http://example.com']);
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
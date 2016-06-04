<?php

use \Mockery as m;

class ScrapeTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        // copy(__DIR__.'/stub_file.txt', __DIR__.'/file.txt');
    }

    public function tearDown()
    {
        m::close();
    }

    private function getClient()
    {
        $client = m::mock('GuzzleHttp\Client');

        return $client;
    }

    public function testClassCreate()
    {
        $scrape = new StaticSites\Sraper\Scrape($this->getClient());
        $this->assertInstanceOf('StaticSites\Sraper\Scrape', $scrape);
    }

    public function _estRun()
    {
        $scrape = new StaticSites\Sraper\Scrape($this->getClient());
        $this->assertInstanceOf('GuzzleHttp\Psr7\Stream', $scrape->run('http://www.example.com'));
    }
}

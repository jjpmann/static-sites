<?php


class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testClassCreate()
    {
        $config = new StaticSites\Config();
        $this->assertInstanceOf('StaticSites\Config', $config);
    }

    public function testParseYaml()
    {
        $config = new StaticSites\Config();

        $file = 'stubs/sample.yml';

        $newConfig = $config->parseYaml($file);
        $this->assertInstanceOf('StaticSites\Config', $newConfig);

        $list = [
            'http://thrice.net/',
            'http://thrice.net/news/',
            'http://thrice.net/shows/',
            'http://thrice.net/videos/',
        ];

        $this->assertEquals('./site-dump/', $newConfig->get('location'));
        $this->assertEquals('http://thrice.net', $newConfig->get('site'));
        $this->assertEquals($list, $newConfig->get('list'));
    }

    public function testParseNoFile()
    {
        $config = new StaticSites\Config();

        $file = 'stubs/sample';

        $newConfig = $config->parseYaml($file);
        $this->assertFalse($newConfig);
    }
}

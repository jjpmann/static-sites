<?php

use \Mockery as m;

class BaseFilesystemTest extends \PHPUnit_Framework_TestCase
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
        $site = isset($options['site']) ? $options['site'] : 'www.example.com';

        $config = m::mock('Illuminate\Config\Repository');
        // /$config->shouldReceive('get')->times(3);
        $config->filesystem['local'] = [
            'type' => 'local',
            'dir'  => './site-dump',
        ];
        $config->filesystem['remote'] = [
            'type' => 'local',
            'dir'  => './site-dump',
        ];
        if (isset($options['local'])) {
            $config->filesystem['local'] = $options['local'];
        }
        if (isset($options['remote'])) {
            $config->filesystem['remote'] = $options['remote'];
        }
        $config->list = $list;
        $config->location = $location;
        $config->site = $site;

        return $config;
    }

    public function testNothing()
    {
    }
}

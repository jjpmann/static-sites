<?php

namespace StaticSites;


use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use StaticSites\Sraper\Scraper;
use StaticSites\Pusher\Pusher;

class StaticSites
{
    public function run($file)
    {
        $config = Config::parseYaml($file);

        $fsLocal = new Filesystem(new Local($config->location));
        $config->set('fsLocal', $fsLocal);

        $scraper = new Scraper($config);
        $scraper->scrape();


        $pusher = new Pusher($config);
        $pusher->push();
        
    }
}

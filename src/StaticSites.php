<?php

namespace StaticSites;

use StaticSites\Pusher\Pusher;
use StaticSites\Sraper\Scraper;
use StaticSites\Filesystem\FS;
//use StaticSites\Filesystem\RemoteFilesystem;

class StaticSites
{

    public function run($file)
    {
        $config = Config::parseYaml($file);

        $fs = FS::create($config);

        $config->set('fsLocal', $fs->fsLocal);
        $config->set('fsRemote', $fs->fsRemote);

        $scraper = new Scraper($config);
        $scraper->scrape();

        $pusher = new Pusher($config);
        $pusher->push();
        
    }
}

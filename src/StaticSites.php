<?php

namespace StaticSites;

use StaticSites\Sraper\Scraper;

class StaticSites
{
    public function run($file)
    {
        $config = Config::parseYaml($file);

        $scraper = new Scraper($config);

        $scraper->scrape();

        var_dump($config);
    }
}

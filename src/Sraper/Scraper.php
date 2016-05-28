<?php

namespace EE\StaticSites;

use Illuminate\Config\Repository;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class Scraper
{
    protected $location;

    protected $fs;

    protected $list = [];

    protected $config;

    protected $domain = 'http://www.lmo.com';

    public function __construct(Repository $config)
    {
        $this->fs = new Filesystem(new Local('..'));
        $this->config = $config;

        $this->list = collect([

        ]);
    }

    public function scrape()
    {
        $this->list->each(function ($item) {
             $this->writePage($item, (new Scrape($item))->run());
        });
    }

    protected function writePage($item, $body)
    {
        $page = $this->getPage($item);

        $write = $this->fs->put($page, "{$body}");

        return $write;
    }

    private function getPage($url)
    {
        $page = $this->reduce_double_slashes($url.'/index.html');
        $page = str_replace($this->domain, '', $page);
        $page = './site-dump/pages'.$page;

        return $page;
    }

    private function reduce_double_slashes($str)
    {
        return preg_replace('#([^/:])/+#', '\\1/', $str);
    }
}

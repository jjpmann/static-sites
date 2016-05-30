<?php

namespace StaticSites\Sraper;

use Illuminate\Config\Repository;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use GuzzleHttp\Client;

class Scraper
{
    protected $fs;
    protected $config;
    
    protected $location;
    protected $list = [];
    protected $site = 'http://www.lmo.com';

    public function __construct(Repository $config)
    {
        $this->config = $config;
    
        $this->fs   = new Filesystem(new Local($config->get('location')));
        $this->list = collect($config->get('list'));
        $this->site = $config->get('site');
    }

    public function scrape()
    {
        $scrape = new Scrape(new Client());
        $this->list->each(function ($item) use ($scrape) {
             $this->writePage($item, $scrape->run($item));
        });
    }

    protected function writePage($item, $body)
    {
        $page = $this->getPage($item);

        $write = $this->fs->put($page, "{$body}");

        return $write;
    }

    public function getPage($url)
    {
        $page = $this->reduce_double_slashes($url.'/index.html');
        $site = $this->reduce_double_slashes($this->site.'/');
        $page = str_replace($site, '', $page);
        $page = $this->location.$page;

        return $page;
    }

    private function reduce_double_slashes($str)
    {
        return preg_replace('#([^/:])/+#', '\\1/', $str);
    }

    public function getList()
    {
        return $this->list;
    }

    public function getSite()
    {
        return $this->site;
    }

}

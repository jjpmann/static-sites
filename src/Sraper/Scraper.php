<?php

namespace StaticSites\Sraper;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;

class Scraper
{
    /**
     * The Flysystem local filesystem implementation.
     *
     * @var \League\Flysystem\Filesystem
     */
    protected $fs;

    /**
     * Config Repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * file path of dump folder.
     *
     * @var string
     */
    protected $location;

    /**
     * URLs to parse.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $list;

    /**
     * URL of the site to be scraped.
     *
     * @var string
     */
    protected $localSite;

    /**
     * URL of the site scrapped site will be hosted.
     *
     * @var string
     */
    protected $remoteSite;

    /**
     * Create a new scraper instance.
     *
     * @param \Illuminate\Config\Repository $config
     *
     * @return void
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;

        $this->fs = $config->fsLocal;
        $this->list = collect($config->list);

        $this->localSite = $config->site['local'];
        $this->remoteSite = $config->site['remote'];
    }

    /**
     * Start the site Scraping process.
     *
     * @return void
     */
    public function scrape()
    {
        $scrape = new Scrape(new Client());
        $this->list->each(function ($url) use ($scrape) {
            $this->writePage($url, $scrape->run($url));
        });
    }

    /**
     * Start the site Scraping process.
     *
     * @param string                  $url
     * @param \GuzzleHttp\Psr7\Stream $body
     *
     * @return void
     */
    protected function writePage($url, $body)
    {
        $page = $this->getPage($url);

        $body = str_replace($this->localSite, $this->remo, "{$body}");

        $write = $this->fs->put($page, $body);

        return $write;
    }

    /**
     * Get static html page name from url.
     *
     * @param string $url
     *
     * @return string
     */
    public function getPage($url)
    {
        $page = $this->reduce_double_slashes($url.'/index.html');
        $site = $this->reduce_double_slashes($this->localSite.'/');
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

    public function getLocalSite()
    {
        return $this->localSite;
    }

    public function getRemoteSite()
    {
        return $this->remoteSite;
    }
}

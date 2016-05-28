<?php

namespace EE\StaticSites;

use GuzzleHttp\Client;

class Scrape
{
    protected $url;

    public function __construct($url)
    {
        $this->url = $url;

        $this->client = new Client();
    }

    public function run()
    {
        $res = $this->client->request('GET', $this->url);

        if ($res->getStatusCode() === 200) {
            return $res->getBody();
        }

        return false;
    }
}

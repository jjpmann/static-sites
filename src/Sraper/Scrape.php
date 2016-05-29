<?php

namespace StaticSites\Sraper;

use GuzzleHttp\Client;

class Scrape
{
    protected $url;

    public function __construct(Client $client)
    {
        $this->client = new Client();
    }

    public function run($url)
    {
        $res = $this->client->request('GET', $url);

        if ($res->getStatusCode() === 200) {
            return $res->getBody();
        }

        return false;
    }
}

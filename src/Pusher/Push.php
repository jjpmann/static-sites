<?php

namespace StaticSites\Pusher;

class Push
{
    protected $fs;
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;

        $this->fs = new Filesystem(new Local($config->get('location')));

        $this->list = collect($config->get('list'));
        $this->site = $config->get('site');
    }
}

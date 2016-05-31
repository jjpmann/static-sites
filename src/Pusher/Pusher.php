<?php

namespace StaticSites\Pusher;

use League\Flysystem\Filesystem;
use Illuminate\Config\Repository;
use League\Flysystem\Adapter\Local;

class Pusher
{
    
    protected $config;

    protected $source;

    protected $desc;

    public function __construct(Repository $config)
    {
        $this->config = $config;

        $this->source = $config->fsLocal;
        $this->desc = $config->fsLocal;

    }

    public function push()
    {
        $contents = collect($this->source->listContents(null, true));

        $contents->each(function($x, $y){
            var_dump($x, $y);
        });
    }
}

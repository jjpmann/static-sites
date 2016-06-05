<?php

namespace StaticSites\Pusher;

use Illuminate\Config\Repository;

class Pusher
{
    protected $config;

    protected $source;

    protected $dest;

    public function __construct(Repository $config)
    {
        $this->config = $config;

        $this->source = $config->fsLocal;
        $this->dest = $config->fsRemote;
    }

    public function push()
    {
        $contents = collect($this->source->listContents(null, true));

        $contents->filter(function ($file) {
            return $file['type'] === 'file';
        })->each(function ($file) {
            $this->dest->put($file['path'], $this->source->read($file['path']));
        });
    }
}

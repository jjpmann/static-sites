<?php

namespace StaticSites\Filesystem;

use League\Flysystem\Filesystem;

class BaseFileSystem
{

    /**
     * Config Repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Create a new remote adapter instance.
     *
     * @param \Illuminate\Config\Repository $config
     *
     * @return void
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getFilesystem()
    {
        return new Filesystem($this->getAdapter());
    }

    public static function create($config)
    {
        $fs = new static($config);
        return $fs->getFilesystem();
    }
}

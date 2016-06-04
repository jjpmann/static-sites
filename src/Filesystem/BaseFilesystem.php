<?php

namespace StaticSites\Filesystem;

use League\Flysystem\Filesystem;
use StaticSites\Filesystem\Adapters\Adapter;

abstract class BaseFileSystem
{

    /**
     * Config Repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Filesystem Type.
     *
     * @var string
     */
    protected $type;

    /**
     * Supported Adapters.
     *
     * @var array
     */
    protected $supportedAdapters = [
        'local' => 'StaticSites\Filesystem\Adapters\LocalAdapter',
        's3'    => 'StaticSites\Filesystem\Adapters\S3Adapter',
        'ftp'   => 'StaticSites\Filesystem\Adapters\FtpAdapter',
        'sftp'  => 'StaticSites\Filesystem\Adapters\SftpAdapter',
    ];

    /**
     * Adapter.
     *
     * @var \StaticSites\Filesystem\Adapters\Adapter
     */
    protected $adapter;

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

        $type = $config->filesystem[$this->type]['type'];

        $this->init($type);
    }

    protected function init($type)
    {

        if (!isset($this->supportedAdapters[$type])) {
            throw new \Exception("Adapter error: {$type} does not exists.", 1);
        }

        $class = $this->supportedAdapters[$type];        
        $this->adapter =  new $class($this->config->filesystem[$this->type]);
    }

    public function getFilesystem()
    {
        return new Filesystem($this->getAdapter());
    }

    public function getAdapter()
    {
        return $this->adapter->getAdapter();
    }

    public static function create($config)
    {
        $fs = new static($config);
        return $fs->getFilesystem();
    }

    public function validate()
    {
        $this->adapter->validate();
    }

}

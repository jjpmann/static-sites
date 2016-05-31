<?php

namespace StaticSites\Filesystem;

class FS
{

    /**
     * Config Repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Local Filesystem.
     *
     * @var \League\Flysystem\Filesystem
     */
    protected $fsRemote;
    
    /**
     * Remote Filesytem.
     *
     * @var \League\Flysystem\Filesystem
     */
    protected $fsLocal;

    public function __construct($config)
    {
        $this->config = $config;

        $this->fsRemote = RemoteFilesystem::create($config);

        $this->fsLocal = LocalFilesystem::create($config);
   
    }

    public function __get($var)
    {
        if (isset($this->$var)) {
            return $this->$var;
        }
        throw new \Exception("Error: Cannot access property \"{$var}\"", 1);
    }

    public static function create($config)
    {
        return new static($config);
    }
}

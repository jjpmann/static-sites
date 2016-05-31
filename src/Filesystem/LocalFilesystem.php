<?php

namespace StaticSites\Filesystem;

use League\Flysystem\Adapter\Local;

class LocalFilesystem extends BaseFilesystem
{
    public function getAdapter()
    {
        return new Local($this->config->location);
    }
}

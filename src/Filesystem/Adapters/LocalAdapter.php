<?php

namespace StaticSites\Filesystem\Adapters;

use League\Flysystem\Adapter\Local;

class LocalAdapter extends Adapter
{
    protected $required = ['dir'];

    protected $type = 'local';

    public function getAdapter()
    {
        $this->validate();

        return new Local($this->get('dir'));
    }
}

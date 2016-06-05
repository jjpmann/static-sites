<?php

namespace StaticSites\Filesystem\Adapters;

use League\Flysystem\Adapter\Ftp;

class FtpAdapter extends Adapter
{
    protected $type = 'ftp';

    protected $required = [
        'host', 'username', 'password',
    ];

    public function getAdapter()
    {
        $this->validate();

        return new Ftp([
            'host'      => $this->settings('host'),
            'username'  => $this->settings('username'),
            'password'  => $this->settings('password'),

            /* optional config settings */
            'port'    => $this->settings('port', 21),
            'root'    => $this->settings('root', ''),
            'passive' => $this->settings('passive', true),
            'ssl'     => $this->settings('ssl', true),
            'timeout' => $this->settings('timeout', 30),
        ]);
    }
}

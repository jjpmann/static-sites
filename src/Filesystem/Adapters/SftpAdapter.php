<?php

namespace StaticSites\Filesystem\Adapters;

use League\Flysystem\Sftp\SftpAdapter as Sftp;

class SftpAdapter extends Adapter
{
    protected $type = 'sftp';

    protected $required = [
        'host', 'username',
        ['password', 'privateKey'],
    ];

    public function getAdapter()
    {
        $this->validate();

        return new Sftp([
            // required
            'host'     => $this->settings('host'),
            'username' => $this->settings('username'),
            // either password or key is required
            'password'   => $this->settings('password', null),
            'privateKey' => $this->settings('privateKey', null),
            // optional
            'port'    => $this->settings('port', 21),
            'root'    => $this->settings('root', ''),
            'timeout' => $this->settings('timeout', 10),
        ]);
    }
}

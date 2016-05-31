<?php

namespace StaticSites\Filesystem;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class RemoteFileSystem extends BaseFilesystem
{

    protected function getAdapter()
    {
         $client = S3Client::factory([
            'credentials' => [
                'key'    => $this->config['aws']['key'],
                'secret' => $this->config['aws']['secret'],
            ],
            'region' => $this->config['aws']['region'],
            'version' => $this->config['aws']['version'],
        ]);
        $bucket = $this->config['aws']['bucket'];
        $adapter = new AwsS3Adapter($client, $bucket);

        return $adapter;
    }
}

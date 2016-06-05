<?php

namespace StaticSites\Filesystem\Adapters;

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class S3Adapter extends Adapter
{
    protected $type = 's3';

    protected $required = [
        'key', 'secret', 'region', 'version', 'bucket',
    ];

    public function getAdapter()
    {
        $this->validate();

        $client = S3Client::factory([
            'credentials' => [
                'key'    => $this->settings('key'),
                'secret' => $this->settings('secret'),
            ],
            'region'  => $this->settings('region'),
            'version' => $this->settings('version'),
        ]);
        $bucket = $this->settings('bucket');

        return new AwsS3Adapter($client, $bucket);
    }
}

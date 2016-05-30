<?php

namespace StaticSites;

use Illuminate\Config\Repository;
use Symfony\Component\Yaml\Yaml;

class Config extends Repository
{
    public static function parseYaml($file)
    {
        if (!file_exists($file)) {
            return false;
        }

        try {
            $config = Yaml::parse(file_get_contents($file));

            return new static($config);
        } catch (Exception $e) {
            die('here');
        }

        return false;
    }

    public function __get($var)
    {
        if ($this->has($var)) {
            return $this->get($var);
        }
    }
}

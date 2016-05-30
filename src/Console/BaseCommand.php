<?php

namespace StaticSites\Console;

use StaticSites\Config;
use Symfony\Component\Console\Command\Command;

class BaseCommand extends Command
{
    protected $output;
    protected $input;

    /**
     * The path of the config file.
     *
     * @var string
     */
    protected $configFile;

    /**
     * The path of the sample config file.
     *
     * @var string
     **/
    protected $configStufFile;

    /**
     * The config settings parsed from config file.
     *
     * @var string
     */
    protected $config;


    /**
     * The base path of the StaticSites installation.
     *
     * @var string
     */
    protected $basePath;
    /**
     * The name of the project folder.
     *
     * @var string
     */
    protected $projectName;
    /**
     * Sluggified Project Name.
     *
     * @var string
     */
    protected $defaultName;

    /**
     * Constructor.
     *
     * @param string|null name of Command
     */
    public function __construct($name = null)
    {
        $this->basePath = getcwd();
        $this->projectName = basename(getcwd());
        $this->defaultName = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->projectName)));

        $this->configFile = $this->basePath.'/static-sites.yml';
        $this->configStufFile = $this->basePath.'/stubs/sample.yml';

        parent::__construct($name);
    }

    protected function checkConfig()
    {
        if (!file_exists($this->configFile)) {
            $this->output->writeLn('<error>No Config file found.</error>');
            $this->output->writeLn('Please run "static-sites make" to create a new config file.');
            exit(1);
        }
    }
}

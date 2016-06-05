<?php

namespace StaticSites\Console;

use StaticSites\Config;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends BaseCommand
{
    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this
            ->setName('test')
            ->setDescription('do some dev stuff.')
            ->addArgument(
                'config',
                InputArgument::OPTIONAL,
                'Path to config.yml file.'
            );
    }

    /**
     * Execute the command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $config = Config::parseYaml($this->configFile);

        var_dump($config);

        $output->writeLn('done');
    }
}

<?php

namespace StaticSites\Console;

use StaticSites\StaticSites;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends BaseCommand
{
    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Create Static Site from config file.')
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

        if ($file = $input->getArgument('config')) {
            $this->configFile = $file;
        }

        $this->checkConfig();

        $ss = new StaticSites();
        $ss->run($this->configFile);

        $output->writeLn('done');
    }
}

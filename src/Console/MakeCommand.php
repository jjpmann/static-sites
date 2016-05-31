<?php

namespace StaticSites\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakeCommand extends BaseCommand
{
    /**
     * Configure the command options.
     */
    protected function configure()
    {
        $this
            ->setName('make')
            ->setDescription('Install Static Sites into current project');
    }

    /**
     * Execute the command.
     *
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

        if (file_exists($this->configFile)) {
            $output->writeLn('Static Sites already installed.');
            exit;
        }
        
        copy($this->configStubFile, $this->configFile);
        $output->writeLn('Static Sites installed.');
    }
}

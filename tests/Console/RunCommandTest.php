<?php

use \Mockery as m;

class RunCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testClassCreate()
    {
        $cmd = new StaticSites\Console\RunCommand();
        $this->assertInstanceOf('StaticSites\Console\RunCommand', $cmd);
    }

    public function testExecute()
    {
        $cmd    = new StaticSites\Console\RunCommand();
        $input  = m::mock('Symfony\Component\Console\Input\InputInterface');
        $output = m::mock('Symfony\Component\Console\Output\OutputInterface');

        $input->shouldReceive('getArgument')->times(1)->andReturn(false);
        $output->shouldReceive('writeln')->times(1);


        $cmd->execute($input, $output);
    }
}

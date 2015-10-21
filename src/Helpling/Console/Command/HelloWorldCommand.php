<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Console\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorldCommand extends Command
{
    protected function configure()
    {
        $this->setName('helpling:hello');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello World!');
    }
}
<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Console\Command;


use Helpling\Solid\Job\GenerateService;
use Helpling\SystemService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JobsGenerateCommand extends Command
{
    private $jobService;

    public function setSystemService(GenerateService $jobService)
    {
        $this->jobService = $jobService;
    }

    protected function configure()
    {
        $this->setName('helpling:jobs:generate')
             ->addArgument('reference', InputArgument::REQUIRED, 'Order reference DEOxyz, where xyz are digits')
             ->setDescription('Generates jobs for the order');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generatedJobs = $this->jobService->generateJobs($input->getArgument('reference'));
        $output->writeln(sprintf('Number of generated jobs: %d', $generatedJobs));
    }

}
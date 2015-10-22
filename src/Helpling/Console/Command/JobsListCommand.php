<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Console\Command;


use Helpling\SystemService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JobsListCommand extends Command
{
    /**
     * @var SystemService
     */
    private $systemService;

    public function setSystemService(SystemService $systemService)
    {
        $this->systemService = $systemService;
    }

    protected function configure()
    {
        $this->setName('helpling:jobs:list')
             ->setDescription('Lists all the jobs for the order')
             ->addArgument('reference', InputArgument::REQUIRED, 'Order reference DEOxyz, where xyz are digits');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $jobs = $this->systemService->getJobs($input->getArgument('reference'));
        $output->writeln(sprintf('Number of jobs: %d', count($jobs)));
        foreach ($jobs as $job) {
            $output->writeln(sprintf("%s  |  %s  |  %s", $job->reference, $job->order_reference, $job->appointment));
        }
    }

}
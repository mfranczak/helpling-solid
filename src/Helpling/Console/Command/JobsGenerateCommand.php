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

class JobsGenerateCommand extends Command
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
        $this->setName('helpling:jobs:generate')
             ->addArgument('reference', InputArgument::REQUIRED, 'Order reference DEOxyz, where xyz are digits')
             ->setDescription('Generates jobs for the order');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generatedJobs = $this->systemService->generateJobs($input->getArgument('reference'));
        $output->writeln(sprintf('Number of generated jobs: %d', $generatedJobs));
    }

}
<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Console\Command;


use Helpling\Solid\Job\ExportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class JobsExportCommand extends Command
{
    /**
     * @var ExportService
     */
    private $exportService;

    public function setExportService(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    protected function configure()
    {
        $this->setName('helpling:jobs:export')
            ->setDescription('Exports all the jobs for the order')
            ->addArgument('reference', InputArgument::REQUIRED, 'Order reference DEOxyz, where xyz are digits');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->exportService->export($input->getArgument('reference'));
        $output->writeln('Done!');
    }


}
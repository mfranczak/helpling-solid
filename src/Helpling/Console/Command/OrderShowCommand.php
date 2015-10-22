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

class OrderShowCommand extends Command
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
        $this->setName('helpling:order:show')
             ->addArgument('reference', InputArgument::REQUIRED, 'Order reference DEOxyz, where xyz are digits')
             ->setDescription('Show if the order exists');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $orderRef = $input->getArgument('reference');
        $result = $this->systemService->getOrder($orderRef);
        $output->writeln($this->formatResult($result, $orderRef));
    }

    /**
     * @param mixed $result
     * @return string
     */
    private function formatResult($result, $reference)
    {
        if (!$result) {
            return 'There is no order with reference = ' . $reference;
        }

        return 'Success! There is an order ' . $result->reference;
    }
}
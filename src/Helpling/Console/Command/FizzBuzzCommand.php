<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Console\Command;


use Helpling\Solid\FizzBuzz\DivideableRule;
use Helpling\Solid\FizzBuzz\FizzBuzzService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FizzBuzzCommand extends Command
{
    protected function configure()
    {
        $this->setName('helpling:task:fizz-buzz')
             ->addArgument('n', InputArgument::REQUIRED, 'Top value')
             ->setDescription('Entry point for the FizzBuzz task');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fizzBuzz = $this->createFizzBuzz();
        $integers = $fizzBuzz->generate($input->getArgument('n'));
        $output->writeln(sprintf('FizzBuzz: %s', rtrim(implode(', ', $integers), ', ')));
    }

    /**
     * @return FizzBuzzService
     */
    private function createFizzBuzz()
    {
        $fizzBuzzService = new FizzBuzzService();
        $fizzBuzzService->addRule(new DivideableRule('FizzBuzz', [3, 5]));
        $fizzBuzzService->addRule(new DivideableRule('Fizz', [3]));
        $fizzBuzzService->addRule(new DivideableRule('Buzz', [5]));
        return $fizzBuzzService;
    }

}
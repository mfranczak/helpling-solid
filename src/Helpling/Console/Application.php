<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Console;


use Helpling\Console\Command\HelloWorldCommand;
use Helpling\Console\Command\JobsExportCommand;
use Helpling\Console\Command\JobsGenerateCommand;
use Helpling\Console\Command\JobsListCommand;
use Helpling\Console\Command\OrderShowCommand;
use Helpling\Solid\Job\ExportService;
use Helpling\Solid\Job\GenerateService;
use Helpling\Solid\Job\Generator\FrequentGenerateStrategy;
use Helpling\Solid\Job\Generator\OneJobGenerateStrategy;
use Helpling\Solid\Job\Generator\OrderTypeStrategyResolver;
use Helpling\Solid\Job\JobRepository;
use Helpling\Solid\Job\JobService;
use Helpling\Solid\Job\Repository\File\FilePersistJob;
use Helpling\Solid\Order\OrderRepository;
use Helpling\SystemService;
use Pimple\Container;

class Application extends \Symfony\Component\Console\Application
{
    /**
     * @var Container
     */
    private $container;

    public function __construct()
    {
        parent::__construct('helpling-console', '0.1.0');

        $this->container = new Container();

        $this->registerServices();
        $this->registerCommands();
    }

    /**
     * Registers services in the DI.
     */
    private function registerServices()
    {
        $this->container['pdo'] = function ($c) {
            $dsn = 'sqlite:/vagrant/app/data/helpling.db';
            $dbh = new \PDO($dsn);
            return $dbh;
        };

        $this->container['jobRepository'] = function ($c) {
            return new JobRepository($c['pdo']);
        };

        $this->container['orderRepository'] = function ($c) {
            return new OrderRepository($c['pdo']);
        };

        $this->container['jobService'] = function ($c) {
            $strategyResolver = new OrderTypeStrategyResolver();
            $strategyResolver->addStrategy('once', new OneJobGenerateStrategy());
            $strategyResolver->addStrategy('weekly', new FrequentGenerateStrategy(7));
            $strategyResolver->addStrategy('biweekly', new FrequentGenerateStrategy(14));

            return new GenerateService(
                $c['orderRepository'],
                $c['jobRepository'],
                $strategyResolver
            );
        };

        $this->container['exportService'] = function ($c) {
            $filePersist = new FilePersistJob('/tmp/jobs.log');
            $service = new ExportService(
                $c['jobRepository'],
                $filePersist

            );
            return $service;
        };
    }

    /**
     * Registers commands for the application.
     */
    private function registerCommands()
    {
        $this->add(new HelloWorldCommand());
        $this->add($this->createOrderShowCommand());
        $this->add($this->createJobsListCommand());
        $this->add($this->createJobsGenerateCommand());
        $this->add($this->createJobsExportCommand());
    }

    private function createJobsExportCommand()
    {
        $cmd = new JobsExportCommand();
        $cmd->setExportService($this->container['exportService']);
        return $cmd;
    }

    private function createOrderShowCommand()
    {
        $cmd = new OrderShowCommand();
        $cmd->setOrderRepository($this->container['orderRepository']);
        return $cmd;
    }

    private function createJobsListCommand()
    {
        $cmd = new JobsListCommand();
        $cmd->setJobRepository($this->container['jobRepository']);
        return $cmd;
    }

    private function createJobsGenerateCommand()
    {
        $cmd = new JobsGenerateCommand();
        $cmd->setSystemService($this->container['jobService']);
        return $cmd;
    }
}
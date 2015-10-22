<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Console;


use Helpling\Console\Command\HelloWorldCommand;
use Helpling\Console\Command\JobsGenerateCommand;
use Helpling\Console\Command\JobsListCommand;
use Helpling\Console\Command\OrderShowCommand;
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

        $this->container['systemService'] = function($c) {
            return new SystemService(
                $c['pdo']
            );
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
    }

    private function createOrderShowCommand()
    {
        $cmd = new OrderShowCommand();
        $cmd->setSystemService($this->container['systemService']);
        return $cmd;
    }

    private function createJobsListCommand()
    {
        $cmd = new JobsListCommand();
        $cmd->setSystemService($this->container['systemService']);
        return $cmd;
    }

    private function createJobsGenerateCommand()
    {
        $cmd = new JobsGenerateCommand();
        $cmd->setSystemService($this->container['systemService']);
        return $cmd;
    }
}
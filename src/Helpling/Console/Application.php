<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Console;


use Helpling\Console\Command\HelloWorldCommand;

class Application extends \Symfony\Component\Console\Application
{
    public function __construct()
    {
        parent::__construct('helpling-console', '0.1.0');
        $this->add(new HelloWorldCommand());
    }
}
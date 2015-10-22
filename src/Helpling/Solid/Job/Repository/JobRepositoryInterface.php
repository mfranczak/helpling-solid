<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job\Repository;


use Helpling\Solid\Job\FindJobsByOrderInterface;
use Helpling\Solid\Job\PersistJobInterface;

interface JobRepositoryInterface extends PersistJobInterface, FindJobsByOrderInterface
{

}
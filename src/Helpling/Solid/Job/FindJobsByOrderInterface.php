<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


use Helpling\Solid\Job\Entity\Job;

interface FindJobsByOrderInterface
{
    /**
     * @param string $reference
     * @return Job[]
     */
    public function getJobs($reference);
}
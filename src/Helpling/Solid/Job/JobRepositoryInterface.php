<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


use Helpling\Solid\Job\Entity\Job;

interface JobRepositoryInterface
{
    /**
     * @param string $reference
     * @return Job[]
     */
    public function getJobs($reference);

    /**
     * @param $reference
     * @param $orderReference
     * @param \DateTime $date
     * @return mixed
     */
    public function persistJob($reference, $orderReference, \DateTime $date);
}
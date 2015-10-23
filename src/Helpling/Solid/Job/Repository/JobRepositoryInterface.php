<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job\Repository;


interface JobRepositoryInterface
{
    /**
     * @param $reference
     * @param $orderReference
     * @param \DateTime $date
     * @return mixed
     */
    public function persistJob($reference, $orderReference, \DateTime $date);

    /**
     * @param string $reference
     * @return Job[]
     */
    public function getJobs($reference);
}
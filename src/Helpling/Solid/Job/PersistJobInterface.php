<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


interface PersistJobInterface
{
    /**
     * @param $reference
     * @param $orderReference
     * @param \DateTime $date
     * @return mixed
     */
    public function persistJob($reference, $orderReference, \DateTime $date);
}
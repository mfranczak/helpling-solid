<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job\Generator;


use Helpling\Solid\Job\Entity\Job;

interface GenerateStrategyInterface
{
    /**
     * @param $orderReference
     * @param $firstAppointment
     * @param $daysInFuture
     * @return Job[]
     */
    public function generate($orderReference, $firstAppointment, $daysInFuture);
}
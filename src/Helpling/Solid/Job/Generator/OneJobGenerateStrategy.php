<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job\Generator;


use Helpling\Solid\Job\Entity\Job;

class OneJobGenerateStrategy implements GenerateStrategyInterface
{

    public function generate($orderReference, $firstAppointment, $daysInFuture)
    {
        return [new Job($orderReference, $firstAppointment)];
    }
}
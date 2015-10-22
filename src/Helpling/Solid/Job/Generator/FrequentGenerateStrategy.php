<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job\Generator;


use Helpling\Solid\Job\Entity\Job;

class FrequentGenerateStrategy implements GenerateStrategyInterface
{
    private $delta;

    public function __construct($delta)
    {
        $this->delta = $delta;
    }

    public function generate($orderReference, $firstAppointment, $daysInFuture)
    {
        $jobs = [];
        $date = new \DateTime();
        $time = 0;

        while ($firstAppointment->diff($date)->format('%a') < $daysInFuture) {
            $date = new \DateTime('+' . $time . 'days');
            $jobs[] = new Job($orderReference, $date);
            $time += $this->delta;
        }

        return $jobs;
    }

}
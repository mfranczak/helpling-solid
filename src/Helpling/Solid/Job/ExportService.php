<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


use Helpling\Solid\Job\Repository\JobRepositoryInterface;

class ExportService
{
    /**
     * @var JobRepositoryInterface
     */
    private $target;

    /**
     * @var JobRepositoryInterface
     */
    private $source;

    public function __construct(
        JobRepositoryInterface $source,
        JobRepositoryInterface $target
    ) {
        $this->source = $source;
        $this->target = $target;
    }

    public function export($orderReference)
    {
        $jobs = $this->source->getJobs($orderReference);
        foreach ($jobs as $job) {
            $this->target->persistJob(
                $job->getReference(),
                $job->getOrderReference(),
                $job->getAppointment()
            );
        }
    }
}
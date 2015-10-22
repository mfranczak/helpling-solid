<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


class ExportService
{
    /**
     * @var PersistJobInterface
     */
    private $target;

    /**
     * @var FindJobsByOrderInterface
     */
    private $source;

    public function __construct(
        FindJobsByOrderInterface $source,
        PersistJobInterface $target
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
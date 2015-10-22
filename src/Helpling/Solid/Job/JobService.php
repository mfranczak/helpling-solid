<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


use Helpling\Solid\Order\OrderRepository;

class JobService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var JobRepository
     */
    private $jobRepository;

    public function __construct(
        OrderRepository $orderRepository,
        JobRepository $jobRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->jobRepository = $jobRepository;
    }

    /**
     * Generate jobs for new 30 days.
     * Returns number of generated jobs.
     *
     * @param string $orderReference
     * @return int
     */
    public function generateJobs($orderReference)
    {
        $order = $this->orderRepository->getOrder($orderReference);
        if (!($order instanceof \stdClass)) {
            return 0;
        }

        if (count($this->jobRepository->getJobs($orderReference)) > 0) {
            return 0;
        }

        $createdJobs = 0;
        switch ($order->type) {
            case 'once':
                $result = $this->jobRepository->persistJob($orderReference, new \DateTime());
                if ($result) {
                    $createdJobs++;
                }
                break;
            case 'weekly':
                $today = new \DateTime();
                $date = new \DateTime();
                $delta = 7;
                $time = 0;
                $queries = 0;

                while ($today->diff($date)->format('%a') < 30) {
                    $date = new \DateTime('+' . $time . 'days');
                    $result = $this->jobRepository->persistJob($orderReference, $date);
                    $queries++;
                    $time += $delta;
                }

                if ($result) {
                    $createdJobs = $queries;
                }
                break;
            default:
                throw new \RuntimeException('Can not generate jobs for orderType=' . $order->type);
        }

        return $createdJobs;
    }
}
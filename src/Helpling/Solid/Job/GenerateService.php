<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


use Helpling\Solid\Job\Generator\OrderTypeStrategyResolver;
use Helpling\Solid\Job\Repository\JobRepositoryInterface;
use Helpling\Solid\Order\OrderRepository;

class GenerateService
{
    const DAYS_IN_FUTURE = 30;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var JobRepositoryInterface
     */
    private $jobRepository;

    /**
     * @var OrderTypeStrategyResolver
     */
    private $generateStrategyResolver;

    public function __construct(
        OrderRepository $orderRepository,
        JobRepositoryInterface $jobRepository,
        OrderTypeStrategyResolver $generateStrategyResolver
    ) {
        $this->orderRepository = $orderRepository;
        $this->jobRepository = $jobRepository;
        $this->generateStrategyResolver = $generateStrategyResolver;
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

        $strategy = $this->generateStrategyResolver->resolve($order->type);
        $createdJobs = $strategy->generate($orderReference, new \DateTime(), self::DAYS_IN_FUTURE);
        foreach ($createdJobs as $job) {
            $this->jobRepository->persistJob(
                $job->getReference(),
                $job->getOrderReference(),
                $job->getAppointment()
            );
        }

        return count($createdJobs);
    }
}
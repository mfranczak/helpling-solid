<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job\Generator;


class OrderTypeStrategyResolver
{
    /**
     * @var GenerateStrategyInterface[]
     */
    private $strategies = [];

    public function addStrategy($type, GenerateStrategyInterface $strategy)
    {
        $this->strategies[$type] = $strategy;
    }
    /**
     * @param $orderType
     * @return GenerateStrategyInterface
     */
    public function resolve($orderType)
    {
        if (!isset($this->strategies[$orderType])) {
            throw new \RuntimeException('Can not resolve generate jobs strategy for orderType=' . $orderType);
        }

        return $this->strategies[$orderType];
    }
}
<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


use Helpling\Solid\Job\Entity\Job;
use Helpling\Solid\Job\Repository\JobRepositoryInterface;

class MongoJobRepository implements JobRepositoryInterface
{
    /**
     * @var \MongoCollection
     */
    private $collection;

    public function __construct(\MongoCollection $collection)
    {
        $this->collection = $collection;
    }

    public function getJobs($reference)
    {
        $cursor = $this->collection->find([
            'order_reference' => $reference
        ]);

        return $this->convert($cursor);
    }

    public function persistJob($reference, $orderReference, \DateTime $date)
    {
        $this->collection->insert([
            'reference' => $reference,
            'order_reference' => $orderReference,
            'appointment' => new \MongoDate($date->getTimestamp())
        ]);
    }

    /**
     * @param $cursor
     * @return array
     */
    private function convert($cursor)
    {
        $result = [];
        foreach ($cursor as $document) {
            $result[] = new Job($document['order_reference'], $document['appointment']->toDateTime(), $document['reference']);
        }

        return $result;
    }
}
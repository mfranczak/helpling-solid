<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job\Entity;


class Job
{
    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $orderReference;

    /**
     * @var string
     */
    private $appointment;

    /**
     * Job constructor.
     * @param string $reference
     * @param string $orderReference
     * @param string $appointment
     */
    public function __construct($orderReference, $appointment, $reference = null)
    {
        $this->reference = (empty($reference) ? $this->generateReference() : $reference);
        $this->orderReference = $orderReference;
        $this->appointment = $appointment;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getOrderReference()
    {
        return $this->orderReference;
    }

    /**
     * @return string
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    /**
     * This should not be here
     * @return string
     */
    private function generateReference()
    {
        return substr(md5(rand(1000, 9999) . time()), 0, 6);
    }
}
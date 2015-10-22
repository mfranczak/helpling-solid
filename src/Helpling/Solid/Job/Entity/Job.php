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
     * @var \DateTime
     */
    private $appointment;

    /**
     * @param string $orderReference
     * @param \DateTime $appointment
     * @param string|null $reference
     */
    public function __construct($orderReference, \DateTime $appointment, $reference = null)
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
     * @return \DateTime
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
<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job;


class JobRepository
{
    /**
     * @var \PDO
     */
    private $dbh;

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * @return array
     */
    public function getJobs($reference)
    {
        $sql = 'SELECT * FROM jobs WHERE order_reference = :reference';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':reference', $reference);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * @param $orderReference
     * @param \DateTime $date
     * @return bool
     */
    public function persistJob($reference, $orderReference, \DateTime $date)
    {
        $appointment = $date->format('Y-m-d H:i:s');
        $sql = "INSERT INTO jobs (reference, order_reference, appointment) VALUES ('$reference', '$orderReference', '$appointment')";
        $stmt = $this->dbh->prepare($sql);
        return $stmt->execute();
    }
}
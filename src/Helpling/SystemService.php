<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling;


class SystemService
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
     * @param string $reference
     * @return \stdClass
     */
    public function getOrder($reference)
    {
        $sql = 'SELECT * FROM orders WHERE reference = :reference';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':reference', $reference);
        $stmt->execute();
        return $stmt->fetchObject();
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
     * Generate jobs for new 30 days.
     * Returns number of generated jobs.
     *
     * @param string $orderReference
     * @return int
     */
    public function generateJobs($orderReference)
    {
        $order = $this->getOrder($orderReference);
        if (!($order instanceof \stdClass)) {
            return 0;
        }

        if (count($this->getJobs($orderReference)) > 0) {
            return 0;
        }

        $createdJobs = 0;
        switch ($order->type) {
            case 'once':
                $this->dbh->beginTransaction();
                $this->createJob($orderReference, new \DateTime());
                $result = $this->dbh->commit();
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

                $this->dbh->beginTransaction();

                while ($today->diff($date)->format('%a') < 30) {
                    $date = new \DateTime('+' . $time . 'days');
                    $this->createJob($orderReference, $date);
                    $queries++;
                    $time += $delta;
                }

                $result = $this->dbh->commit();
                if ($result) {
                    $createdJobs = $queries;
                }
                break;
            default:
                throw new \RuntimeException('Can not generate jobs for orderType=' . $order->type);
        }

        return $createdJobs;
    }

    private function createJob($orderReference, \DateTime $date)
    {
        $reference = substr(md5(rand(1000, 9999) . time() . $orderReference), 0, 6);
        $appointment = $date->format('Y-m-d H:i:s');
        $sql = "INSERT INTO jobs (reference, order_reference, appointment) VALUES ('$reference', '$orderReference', '$appointment')";
        $stmt = $this->dbh->prepare($sql);
        return $stmt->execute();
    }
}
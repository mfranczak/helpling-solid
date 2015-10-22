<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Order;


class OrderRepository
{
    /**
     * @var \PDO
     */
    private $dbh;

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function getOrder($reference)
    {
        $sql = 'SELECT * FROM orders WHERE reference = :reference';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindParam(':reference', $reference);
        $stmt->execute();
        return $stmt->fetchObject();
    }
}
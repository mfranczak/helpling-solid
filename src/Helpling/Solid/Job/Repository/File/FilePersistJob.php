<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\Job\Repository\File;


use Helpling\Solid\Job\Repository\JobRepositoryInterface;

class FilePersistJob implements JobRepositoryInterface
{
    private $handle;

    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function __destruct()
    {
        if ($this->handle) {
            fclose($this->handle);
        }
    }

    public function persistJob($reference, $orderReference, \DateTime $date)
    {
        if (!$this->handle) {
            $this->handle = fopen($this->fileName, 'a+');
        }

        fputcsv($this->handle, [
            $reference,
            $orderReference,
            $date->format('Y-m-d H:i:s')
        ]);
    }

    public function getJobs($reference)
    {
        throw new \Exception("Can't be implemented.");
    }
}
<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Iterator;


class CollectionIterator implements \Iterator
{
    private $array;

    private $size;

    private $current = 0;

    public function __construct(array $array)
    {
        $this->array = $array;
        $this->size = count($array);
    }

    public function current()
    {
        return $this->array[$this->current];
    }

    public function next()
    {
        $this->current++;
    }

    public function key()
    {
        return $this->current;
    }

    public function valid()
    {
        return ($this->current < $this->size);
    }

    public function rewind()
    {
        $this->current = 0;
    }
}
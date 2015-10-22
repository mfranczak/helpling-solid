<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\FizzBuzz;


class FizzBuzzService
{
    /**
     * Generate a list of integers, from 1 to n.  
     *
     * @param int $n
     * @return array
     */
    public function generate($n)
    {
        $result = [];

        for ($i = 1; $i <= $n; $i++) {
            if ($i % 3 == 0 && $i % 5 == 0) {
                $result[] = 'FizzBuzz';
            } elseif ($i % 3 == 0) {
                $result[] = 'Fizz';
            } elseif ($i % 5 == 0) {
                $result[] = 'Buzz';
            } else {
                $result[] = $i;
            }
        }

        return $result;
    }
}
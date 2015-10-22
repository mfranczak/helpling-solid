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
     * @var RuleInterface[]
     */
    private $rules = [];

    public function addRule(RuleInterface $rule) {
        $this->rules[] = $rule;
    }

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
            $result[] = $this->getElement($i);
        }

        return $result;
    }

    /**
     * @param $i
     * @return mixed
     */
    private function getElement($i)
    {
        foreach ($this->rules as $rule) {
            if ($rule->applies($i)) {
                return $rule->getReplacement();
            }
        }

        return $i;
    }
}
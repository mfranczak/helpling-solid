<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\FizzBuzz;


interface RuleInterface
{
    /**
     * Checks if the Rule applies to the given integer.
     *
     * @param int $integer
     * @return bool
     */
    public function applies($integer);

    /**
     * Returns the value that replaces the integer when the Rule applies.
     * @return mixed
     */
    public function getReplacement();
}
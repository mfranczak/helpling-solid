<?php
/**
 *
 * @author Michal Franczak <michal.franczak@helpling.com>
 * @link
 */

namespace Helpling\Solid\FizzBuzz;


/**
 * Class DivideableRule
 * The rule applies when integer is dividable by all divs passed to __construct.
 *
 * @package Helpling\Solid\FizzBuzz
 */
class DivideableRule implements RuleInterface
{
    /**
     * @var string
     */
    private $replacement;

    /**
     * @var array
     */
    private $divs;

    public function __construct($replacement, array $divs)
    {
        $this->replacement = $replacement;
        $this->divs = $divs;
    }

    public function applies($integer)
    {
        foreach ($this->divs as $x) {
            if ($integer % $x !== 0) {
                return false;
            }
        }

        return true;
    }

    public function getReplacement()
    {
        return $this->replacement;
    }

}
<?php

namespace Paliari\TextObject\Filters;

/**
 * Class AbstractFilter
 * @package Paliari\TextObject\Filters
 */
abstract class AbstractFilter
{

    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
        $this->init();
    }

    protected function init()
    {
    }

    protected function __toString()
    {
        return (string)$this->value;
    }
}
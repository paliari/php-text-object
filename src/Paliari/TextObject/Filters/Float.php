<?php

namespace Paliari\TextObject\Filters;

/**
 * Class Float
 * @package Paliari\TextObject\Filters
 */
class Float extends AbstractFilter
{

    protected function init()
    {
        $this->value = round($this->value, 2);
    }
} 
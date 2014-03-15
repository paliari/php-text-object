<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FFloat
 * @package Paliari\TextObject\Filters
 */
class FDouble extends AbstractFilter
{

    protected function init()
    {
        $this->type = 'double';
    }

    public function convert()
    {
        $this->validate();
        return round($this->value, 2);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->required) {
            return is_numeric($this->value);
        }
        return $this->value ? is_numeric($this->value) : true;
    }
}
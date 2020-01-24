<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FDouble
 * @package Paliari\TextObject\Filters
 */
class FDouble extends AbstractFilter
{
    protected $precision = 2;

    protected function init()
    {
        $this->type = Types::DOUBLE;
    }

    public function convert()
    {
        $this->validate();

        return round($this->value, $this->precision);
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

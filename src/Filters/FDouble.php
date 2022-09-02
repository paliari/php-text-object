<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FDouble
 * @package Paliari\TextObject\Filters
 */
class FDouble extends AbstractFilter
{
    protected int $precision = 2;

    protected function init(): void
    {
        $this->type = Types::DOUBLE;
    }

    public function convert(): float
    {
        $this->validate();

        return round((double)$this->value, $this->precision);
    }

    public function isValid(): bool
    {
        if ($this->required) {
            return is_numeric($this->value);
        }

        return !$this->value || is_numeric($this->value);
    }
}

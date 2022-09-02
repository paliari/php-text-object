<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FInt2Double
 * @package Paliari\TextObject\Filters
 */
class FInt2Double extends AbstractFilter
{
    protected function init(): void
    {
        $this->type = Types::INT_2_DOUBLE;
    }

    protected int $divisor = 100;

    public function setDivisor(int $divisor): void
    {
        $this->divisor = $divisor;
    }

    public function convert(): float
    {
        $this->validate();

        return (float)((int)$this->value / $this->divisor);
    }

    public function isValid(): bool
    {
        if ($this->required) {
            return $this->isInt();
        }

        return !$this->value || $this->isInt();
    }

    protected function isInt(): bool
    {
        $value = ltrim($this->value, '0');
        if (!$value && !$this->required) {
            return true;
        }

        return false !== filter_var($value, FILTER_VALIDATE_INT);
    }
}

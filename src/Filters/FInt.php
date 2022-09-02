<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FInt
 * @package Paliari\TextObject\Filters
 */
class FInt extends AbstractFilter
{
    public function convert(): int
    {
        $this->validate();

        return (int)$this->value;
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
        if ('' === $value && !$this->required) {
            return true;
        }

        return false !== filter_var($value, FILTER_VALIDATE_INT);
    }

    protected function init(): void
    {
        $this->type = Types::INT;
    }
} 

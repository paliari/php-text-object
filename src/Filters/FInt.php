<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FInt
 * @package Paliari\TextObject\Filters
 */
class FInt extends AbstractFilter
{
    public function convert()
    {
        $this->validate();

        return (int)$this->value;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->required) {
            return $this->isInt();
        }

        return $this->value ? $this->isInt() : true;
    }

    protected function isInt()
    {
        $value = ltrim($this->value, '0');
        if ('' === $value && !$this->required) {
            return true;
        }

        return false !== filter_var($value, FILTER_VALIDATE_INT);
    }

    protected function init()
    {
        $this->type = Types::INT;
    }
} 

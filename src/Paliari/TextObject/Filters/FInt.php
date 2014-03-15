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

    protected function init()
    {
        $this->type = 'int';
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
        return is_numeric($this->value) && false === strpos($this->value, '.');
    }
} 
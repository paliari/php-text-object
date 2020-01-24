<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FNumberString
 * Strings numericas, para numeros com zeros a esquerda.
 *
 * @package Paliari\TextObject\Filters
 */
class FNumberString extends AbstractFilter
{
    protected function init()
    {
        $this->type = Types::NUMBER_STRING;
    }

    public function convert()
    {
        $this->value = preg_replace('/[^0-9]/', '', $this->value);
        $this->validate();

        return $this->value;
    }
} 

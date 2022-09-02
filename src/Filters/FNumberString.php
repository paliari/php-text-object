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
    protected function init(): void
    {
        $this->type = Types::NUMBER_STRING;
    }

    public function convert(): string
    {
        $this->value = preg_replace('/\D/', '', $this->value);
        $this->validate();

        return (string)$this->value;
    }
} 

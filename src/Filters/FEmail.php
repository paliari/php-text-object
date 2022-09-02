<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FEmail
 * @package Paliari\TextObject\Filters
 */
class FEmail extends AbstractFilter
{
    protected function init(): void
    {
        $this->type = Types::EMAIL;
    }

    public function isValid(): bool
    {
        if ($this->required) {
            return $this->isEmail();
        }

        return !$this->value || $this->isEmail();
    }

    protected function isEmail(): bool
    {
        return (bool)filter_var($this->value, FILTER_VALIDATE_EMAIL);
    }
}

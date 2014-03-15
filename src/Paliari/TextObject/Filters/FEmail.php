<?php

namespace Paliari\TextObject\Filters;
/**
 * Class FEmail
 * @package Paliari\TextObject\Filters
 */
class FEmail extends AbstractFilter
{

    protected function init()
    {
        $this->type = 'email';
    }

    /**
     * @return bool|string
     */
    public function isValid()
    {
        if ($this->required) {
            return $this->isEmail();
        }

        return $this->value ? $this->isEmail() : true;
    }

    protected function isEmail()
    {
        return filter_var($this->value, FILTER_VALIDATE_EMAIL);
    }
}
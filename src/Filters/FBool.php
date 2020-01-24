<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FBool
 * @package Paliari\TextObject\Filters
 */
class FBool extends FString
{
    protected $trues = ['1', 'Y', 'S', 'TRUE'];

    protected function init()
    {
        $this->type = Types::BOOL;
    }

    /**
     * @return bool
     */
    public function convert()
    {
        $this->value = strtoupper(parent::convert());

        return in_array($this->value, $this->trues);
    }
}

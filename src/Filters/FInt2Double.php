<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FInt2Double
 * @package Paliari\TextObject\Filters
 */
class FInt2Double extends FInt
{
    protected function init()
    {
        $this->type = Types::INT_2_DOUBLE;
    }

    /**
     * @var int
     */
    protected $divisor = 100;

    public function convert()
    {
        $this->value = parent::convert();

        return $this->value / $this->divisor;
    }
}

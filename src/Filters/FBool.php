<?php

namespace Paliari\TextObject\Filters;

/**
 * Class FBool
 * @package Paliari\TextObject\Filters
 */
class FBool extends FString
{
    protected array $trues = ['1', 'y', 's', 'true'];

    protected function init(): void
    {
        $this->type = Types::BOOL;
    }

    public function convert(): bool
    {
        $this->value = strtolower((string)parent::convert());

        return in_array($this->value, $this->trues);
    }
}

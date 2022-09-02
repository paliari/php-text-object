<?php

namespace Paliari\TextObject\Filters;

interface FilterInterface
{
    public function convert(): mixed;

    public function validate(): void;

    public function isValid(): bool;

    public function __invoke(?string $value): mixed;

    public function __toString(): string;
}

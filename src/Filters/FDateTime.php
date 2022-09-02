<?php

namespace Paliari\TextObject\Filters;

use DateTime;

/**
 * Class FDateTime
 * @package Paliari\TextObject\Filters
 */
class FDateTime extends AbstractFilter
{
    protected string $format = 'Y-m-d H:i:s';

    protected ?DateTime $date = null;

    public function setFormat($value): static
    {
        $this->format = $value;

        return $this;
    }

    public function convert(): DateTime|null
    {
        $this->toDateTime();
        $this->validate();

        return $this->date;
    }

    /**
     * Convert string e DateTime.
     */
    public function toDateTime(): ?DateTime
    {
        $time = preg_replace('/\D+/', '', (string)$this->value);
        if ($this->isOnlyZero($time)) {
            $this->value = '';
            $this->date = null;
        } else {
            $format = preg_replace('/[^a-zA-Z]+/', '', $this->format);
            $this->date = DateTime::createFromFormat($format, $time) ?: null;
            $this->time();
        }

        return $this->date;
    }

    /**
     * Check se o time pode ser convertido em data, se conter somente zero eh false.
     */
    protected function isOnlyZero($time): bool
    {
        return in_array($time, ['00000000', '00000000000000'], true);
    }

    /**
     * zera time caso nao tenha passado no format.
     */
    protected function time()
    {
        if ($this->date) {
            $f = ['H', 'i', 's'];
            $t = false;
            foreach ($f as $v) {
                if (str_contains($this->format, $v)) {
                    $t = true;
                    break;
                }
            }
            if (!$t) {
                $this->date->setTime(0, 0, 0);
            }
        }
    }

    public function isValid(): bool
    {
        if ($this->required || $this->value) {
            return (bool)$this->date;
        }

        return true;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    protected function init(): void
    {
        $this->type = Types::DATE_TIME;
    }
}

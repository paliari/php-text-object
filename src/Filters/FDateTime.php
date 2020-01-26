<?php

namespace Paliari\TextObject\Filters;

use DateTime;

/**
 * Class FDateTime
 * @package Paliari\TextObject\Filters
 */
class FDateTime extends AbstractFilter
{
    /**
     * @var string
     */
    protected $format = 'Y-m-d H:i:s';

    /**
     * @var DateTime
     */
    protected $date;

    /**
     * @param string $value
     *
     * @return FDateTime
     */
    public function setFormat($value)
    {
        $this->format = $value;

        return $this;
    }

    /**
     * @return DateTime|mixed
     */
    public function convert()
    {
        $this->toDateTime();
        $this->validate();

        return $this->date;
    }

    /**
     * Convert string e DateTime.
     *
     * @return DateTime
     */
    public function toDateTime()
    {
        $time = preg_replace('/[^\d]+/', '', $this->value);
        if ($this->isTimeValid($time)) {
            $format     = preg_replace('/[^a-zA-Z]+/', '', $this->format);
            $this->date = DateTime::createFromFormat($format, $time) ?: null;
            $this->time();
        }

        return $this->date;
    }

    /**
     * Check se o time pode ser convertido em data, se conter somente zero eh false.
     *
     * @param string $time
     *
     * @return bool
     */
    protected function isTimeValid($time)
    {
        return $time && preg_match('/[^0]/', $time);
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
                if (false !== strpos($this->format, $v)) {
                    $t = true;
                    break;
                }
            }
            if (!$t) {
                $this->date->setTime(0, 0, 0);
            }
        }
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->required || $this->value) {
            return (bool)$this->date;
        }

        return true;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    protected function init()
    {
        $this->type = Types::DATE_TIME;
    }
}

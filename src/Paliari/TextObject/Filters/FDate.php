<?php

namespace Paliari\TextObject\Filters;

use DateTime;

/**
 * Class FDate
 * @package Paliari\TextObject\Filters
 */
class FDate extends AbstractFilter
{

    /**
     * @var array
     */
    protected $masks = array('Y', 'M', 'D', 'H', 'I', 'S');

    /**
     * @var array
     */
    protected $parts = array(
        'Y' => '',
        'M' => '',
        'D' => '',
        'H' => '',
        'I' => '',
        'S' => '',
    );

    /**
     * @var string
     */
    protected $format = '';

    protected function init()
    {
        $this->type = 'DateTime';
    }

    /**
     * @param string $value
     *
     * @return FDate
     */
    public function setFormat($value = 'YYYY-MM-DD HH:II:SS')
    {
        $this->format = $value;

        return $this;
    }

    /**
     * @return DateTime|mixed
     */
    public function convert()
    {
        $format = str_split($this->format, 1);
        $values = str_split($this->value, 1);
        foreach ($format as $k => $ch) {
            if ($this->isMask($ch)) {
                $this->parts[$ch] .= $values[$k];
            }
        }
        $this->prepareDate();
        $date = $this->dateString();
        $this->validate();

        return $this->toDateTime($date);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $time = strtotime($this->dateString());
        if ($this->required) {
            return $time;
        }

        return $this->value ? $time : true;
    }

    /**
     * Verifica se é uma caracter de mascara.
     *
     * @param string $ch
     *
     * @return bool
     */
    protected function isMask($ch)
    {
        return in_array($ch, $this->masks);
    }

    protected function prepareDate()
    {
        foreach ($this->parts as $k => $v) {
            $this->parts[$k] = str_pad($v, 2, '0', STR_PAD_LEFT);
        }
    }

    /**
     * Convert string e DateTime.
     *
     * @param string $value
     *
     * @return DateTime
     */
    public function toDateTime($value)
    {
        return new DateTime($value);
    }

    /**
     * @return string
     */
    protected function dateString()
    {
        $d = $this->parts;

        return "$d[Y]-$d[M]-$d[D] $d[H]:$d[I]:$d[S]";
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->dateString();
    }
}
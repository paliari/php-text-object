<?php

namespace Paliari\TextObject;

use Paliari\TextObject\Filters\AbstractFilter;

/**
 * Class Column representa uma coluna de uma row do arquivo.
 *
 * @package Paliari\TextObject
 */
class Column
{
    protected $init = 0;

    protected $length = 0;

    protected $type;

    /**
     * @param int                  $init
     * @param int                  $length
     * @param AbstractFilter|mixed $type
     */
    public function __construct($init = 0, $length = 0, $type = null)
    {
        $this->setInit($init)
            ->setLength($length)
            ->setType($type);
    }

    /**
     * Posicao inicial na linha do arquivo.
     *
     * @param int $init
     *
     * @return Column
     */
    public function setInit($init)
    {
        $this->init = (int)$init;

        return $this;
    }

    /**
     * Posicao inicial na linha do arquivo.
     *
     * @return int
     */
    public function getInit()
    {
        return $this->init;
    }

    /**
     * Comprimento do campo.
     *
     * @param int $length
     *
     * @return Column
     */
    public function setLength($length)
    {
        $this->length = (int)$length;

        return $this;
    }

    /**
     * Comprimento do campo.
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Tipo de dados a ser convertido (string, int, double, DateTime).
     *
     * @param AbstractFilter $type
     *
     * @return Column
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Tipo de dados a ser convertido (string, int, double, DateTime).
     *
     * @return AbstractFilter
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Extrai o value da linha.
     *
     * @param string $content
     *
     * @return string
     */
    public function extractValue($content)
    {
        $value = trim(mb_substr($content, $this->getInit(), $this->getLength(), 'utf-8'));
//        $value = trim(substr($content, $this->getInit(), $this->getLength()));
        $type  = $this->type;

        return $type ? $type($value) : $value;
    }
}
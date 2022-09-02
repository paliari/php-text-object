<?php

namespace Paliari\TextObject;

use Paliari\TextObject\Filters\FilterInterface;

/**
 * Class Column representa uma coluna de uma row do arquivo.
 *
 * @package Paliari\TextObject
 */
class Column
{
    protected int $init = 0;

    protected int $length = 0;

    protected ?FilterInterface $type = null;

    public function __construct(int $init = 0, int $length = 0, ?FilterInterface $type = null)
    {
        $this->setInit($init)
            ->setLength($length)
            ->setType($type);
    }

    /**
     * Posicao inicial na linha do arquivo.
     */
    public function setInit(int $init): static
    {
        $this->init = $init;

        return $this;
    }

    /**
     * Posicao inicial na linha do arquivo.
     */
    public function getInit(): int
    {
        return $this->init;
    }

    public function setLength(int $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setType(FilterInterface $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Tipo de dados a ser convertido (string, int, double, DateTime).
     */
    public function getType(): ?FilterInterface
    {
        return $this->type;
    }

    /**
     * Extrai o value da linha.
     */
    public function extractValue(string $line): mixed
    {
        $value = trim(mb_substr($line, $this->getInit(), $this->getLength(), 'utf-8'));

        return $this->type ? call_user_func($this->type, $value) : $value;
    }
}

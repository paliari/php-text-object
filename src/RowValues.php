<?php

namespace Paliari\TextObject;

/**
 * Class RowValues
 * @package Paliari\TextObject
 */
class RowValues
{
    /**
     * Conteudo total da linha do arquivo.
     */
    protected string $content = '';

    protected array $values = [];

    public function __construct(protected RowParams $params, string $content = '')
    {
        $this->setContent($content);
    }

    public function parse(): array
    {
        foreach ($this->params->getColumns() as $k => $column) {
            if ($column instanceof Column) {
                $this->values[$k] = $column->extractValue($this->getContent());
            }
        }

        return $this->values;
    }

    public function setContent(string $content): static
    {
        $this->content = $this->isUtf8($content) ? $content : utf8_encode($content);

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function __toString(): string
    {
        return $this->getContent();
    }

    protected function isUtf8($str): bool
    {
        return preg_match('//u', $str) || mb_check_encoding($str, 'UTF-8');
    }
}

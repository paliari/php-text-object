<?php

namespace Paliari\TextObject;

use Exception;

/**
 * Class File
 * @package Paliari\TextObject
 */
class File
{
    protected string $name = '';

    protected array $rows = [];

    protected mixed $resource = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Obtem o conteudo do arquivo em array por linhas.
     * @throws Exception
     */
    public function load(): array
    {
        if (file_exists($this->name)) {
            $this->rows = file($this->name, 0);

            return $this->rows;
        } else {
            throw new Exception('Arquivo inexistente!');
        }
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * Abre o arquivo
     * @throws Exception
     */
    public function open(string $mode = 'r'): static
    {
        if (file_exists($this->name)) {
            $this->resource = fopen($this->name, $mode);
        } else {
            throw new Exception('Arquivo inexistente!');
        }

        return $this;
    }

    /**
     * Retorna uma linha do ponteiro do arquivo.
     */
    public function getRow(): bool|string
    {
        return fgets($this->resource);
    }

    /**
     * Fecha o ponteiro do arquivo aberto
     */
    public function close(): bool
    {
        return fclose($this->resource);
    }
}

<?php

namespace Paliari\TextObject;

use Exception;

/**
 * Class File
 * @package Paliari\TextObject
 */
class File
{
    protected $name = '';

    protected $rows = [];

    protected $resource;

    /**
     * @param string $name nome do arquivo
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Obtem o conteudo do arquivo em array por linhas.
     *
     * @return array
     *
     * @throws Exception
     */
    public function load()
    {
        if (file_exists($this->name)) {
            $this->rows = file($this->name, 0);

            return $this->rows;
        } else {
            throw new Exception('Arquivo inexistente!');
        }
    }

    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * Abre o arquivo
     *
     * @param string $mode
     *
     * @return $this
     * @throws Exception
     */
    public function open($mode = 'r')
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
     *
     * @return false|string
     */
    public function getRow()
    {
        return fgets($this->resource);
    }

    /**
     * Fecha o ponteiro do arquivo aberto
     *
     * @return bool
     */
    public function close()
    {
        return fclose($this->resource);
    }
}

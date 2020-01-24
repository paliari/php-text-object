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
}

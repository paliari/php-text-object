<?php

namespace Paliari\TextObject;

use Paliari\TextObject\File;

/**
 * Class FileFacade
 * @package Paliari\TextObject
 */
class FileFacade
{

    /**
     * @var File
     */
    protected $file;

    /**
     * @var RowParams
     */
    protected $params;

    /**
     * @param string $file_name
     */
    public function __construct($file_name)
    {
        $this->file   = new File($file_name);
        $this->params = new RowParams();
    }

    /**
     * @param string $file_name
     *
     * @return FileFacade
     */
    public static function create($file_name)
    {
        return new static($file_name);
    }

    /**
     * Adiciona as colunas para ler o arquivo.
     *
     * @param string $name
     * @param int    $start
     * @param int    $length
     * @param null   $type
     *
     * @return FileFacade
     */
    public function addColumn($name, $start, $length, $type = null)
    {
        $this->params->addColumn($name, new Column($start, $length, $type));

        return $this;
    }

    /**
     * Obtem o conteudo do arquivo em uma array de array mapeado com os valores convertidos.
     *
     * @return array
     */
    public function exec()
    {
        $result = array();
        $this->file->load();
        foreach ($this->file->getRows() as $v) {
            $rv       = new RowValues($this->params, $v);
            $result[] = $rv->parse();
        }

        return $result;
    }
}

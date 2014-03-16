<?php

namespace Paliari\TextObject;

use Paliari\TextObject\Filters\AbstractFilter,
    Paliari\TextObject\Filters\Types;

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
     * @param string                $name
     * @param int                   $start
     * @param int                   $length
     * @param AbstractFilter|string $type
     * @param bool                  $required
     *
     * @return FileFacade
     */
    public function addColumn($name, $start, $length, $type = null, $required = false)
    {
        if (is_string($type)) {
            $type = Types::getType($type, $required);
        }
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
        $this->params->validate();
        $result = array();
        $this->file->load();
        foreach ($this->file->getRows() as $v) {
            $rv       = new RowValues($this->params, $v);
            $result[] = $rv->parse();
        }

        return $result;
    }
}

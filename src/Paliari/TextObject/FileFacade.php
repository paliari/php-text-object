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

    public function __construct()
    {
        $this->params = new RowParams();
    }

    /**
     *
     * @return FileFacade
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Adiciona as colunas para ler o arquivo.
     *
     * @param string                $name
     * @param int                   $start
     * @param int                   $length
     * @param AbstractFilter|string $type
     * @param bool|array            $config array de config ou bool apenas obrigatorio
     *
     * @return FileFacade
     */
    public function addColumn($name, $start, $length, $type = null, $config = false)
    {
        if (is_string($type)) {
            $type = Types::getType($type, $config);
        }
        $this->params->addColumn($name, new Column($start, $length, $type));

        return $this;
    }

    /**
     * Obtem o conteudo do arquivo em uma array de array mapeado com os valores convertidos.
     *
     * @param string $file_name
     *
     * @return array
     */
    public function exec($file_name)
    {
        $this->file   = new File($file_name);

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

<?php

namespace Paliari\TextObject;

use DomainException;
use Exception;
use Paliari\TextObject\Filters\AbstractFilter;
use Paliari\TextObject\Filters\Types;

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
     * Array de params.
     *
     * @var array
     */
    protected $params_maps = [];

    /**
     * @var int
     */
    protected $rows_key_length = 0;

    public function __construct($rows_key_length = 0)
    {
        $this->rows_key_length = $rows_key_length;
    }

    /**
     * @param int $rows_key_length
     *
     * @return FileFacade
     */
    public static function create($rows_key_length = 0)
    {
        return new static($rows_key_length);
    }

    /**
     * Adiciona as colunas para ler o arquivo.
     *
     * @param int                   $start
     * @param int                   $length
     * @param AbstractFilter|string $type
     * @param bool|array            $config array de config ou bool apenas obrigatorio
     *
     * @return Column
     */
    public function createColumn($start, $length, $type = null, $config = false)
    {
        if (is_string($type)) {
            $type = Types::getType($type, $config);
        }

        return new Column($start, $length, $type);
    }

    /**
     * @param int $length
     *
     * @return $this
     */
    public function setRowsKeyLength($length)
    {
        $this->rows_key_length = $length;

        return $this;
    }

    /**
     * @return int
     */
    public function getRowsKeyLength()
    {
        return $this->rows_key_length;
    }

    /**
     * @param RowParams $params_map
     * @param           $key
     *
     * @return $this
     */
    public function setParams($params_map, $key)
    {
        $this->params_maps[$key] = $params_map;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return RowParams
     */
    public function getParams($key = '')
    {
        return $this->params_maps[$key] = $this->params_maps[$key] ?? new RowParams();
    }

    /**
     * Adiciona as colunas para ler o arquivo.
     *
     * @param string                $row_key
     * @param string                $name
     * @param int                   $start
     * @param int                   $length
     * @param AbstractFilter|string $type
     * @param bool|array            $config array de config ou bool apenas obrigatorio
     *
     * @return FileFacade
     */
    public function addColumn($row_key, $name, $start, $length, $type = null, $config = false)
    {
        $this->getParams($row_key)->addColumn($name, $this->createColumn($start, $length, $type, $config));

        return $this;
    }

    /**
     * Obtem o conteudo do arquivo em uma array de array mapeado com os valores convertidos.
     *
     * @param string $file_name
     *
     * @return array
     *
     * @throws Exception
     */
    public function exec($file_name)
    {
        $ln = 0;
        try {
            $this->newFile($file_name);
            $result = [];
            $this->file->load();
            foreach ($this->file->getRows() as $line) {
                $ln++;
                $rv       = $this->getRowValues($line);
                $result[] = $rv->parse();
            }
        } catch (DomainException $e) {
            throw new DomainException($e->getMessage() . " linha: $ln");
        } catch (Exception $e) {
            throw new Exception($e->getMessage() . " linha: $ln");
        }

        return $result;
    }

    /**
     * Executa o conteudo do arquivo linha por linha,
     * chamando o $onRow com array mapeado dos valores convertidos e o numero da linha.
     *
     * @param string   $file_name
     * @param callable $onRow ($row, $index)
     *
     * @throws Exception
     */
    public function execRowByRow($file_name, $onRow)
    {
        $ln = 0;
        try {
            $this->newFile($file_name);
            $this->file->open();
            while ($line = $this->file->getRow()) {
                $ln++;
                $rv = $this->getRowValues($line);
                call_user_func($onRow, $rv->parse(), $ln);
            }
            $this->file->close();
        } catch (DomainException $e) {
            throw new DomainException($e->getMessage() . " linha: $ln");
        } catch (Exception $e) {
            throw new Exception($e->getMessage() . " linha: $ln");
        }
    }

    protected function newFile($file_name)
    {
        $this->file = new File($file_name);
        $this->validate();
    }

    protected function getRowValues($line)
    {
        $key = $this->getRowsKeyLength() ? substr($line, 0, $this->getRowsKeyLength()) : '';

        return new RowValues($this->getParams($key), $line);
    }

    /**
     * Validate rows params.
     */
    protected function validate()
    {
        foreach ($this->params_maps as $k => $v) {
            $v->validate();
        }
    }
}

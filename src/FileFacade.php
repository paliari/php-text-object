<?php

namespace Paliari\TextObject;

use DomainException;
use Exception;
use Paliari\TextObject\Filters\FilterInterface;
use Paliari\TextObject\Filters\Types;

/**
 * Class FileFacade
 * @package Paliari\TextObject
 */
class FileFacade
{
    protected ?File $file = null;

    protected array $params_maps = [];

    protected int $rows_key_length = 0;

    public function __construct(int $rows_key_length = 0)
    {
        $this->rows_key_length = $rows_key_length;
    }

    public static function create(int $rows_key_length = 0): FileFacade
    {
        return new static($rows_key_length);
    }

    /**
     * Adiciona as colunas para ler o arquivo.
     */
    public function createColumn(
        int $start,
        int $length,
        FilterInterface|string $type = null,
        bool|array $config = false,
    ): Column
    {
        if (is_string($type)) {
            $type = Types::getType($type, $config);
        }

        return new Column($start, $length, $type);
    }

    public function setRowsKeyLength(int $length): static
    {
        $this->rows_key_length = $length;

        return $this;
    }

    public function getRowsKeyLength(): int
    {
        return $this->rows_key_length;
    }

    public function setParams(RowParams $params_map, string $key): static
    {
        $this->params_maps[$key] = $params_map;

        return $this;
    }

    public function getParams(string $key = ''): RowParams
    {
        return $this->params_maps[$key] = $this->params_maps[$key] ?? new RowParams();
    }

    /**
     * Adiciona as colunas para ler o arquivo.
     */
    public function addColumn(
        string $row_key,
        string $name,
        int $start,
        int $length,
        FilterInterface|string $type = null,
        bool|array $config = false,
    ): static
    {
        $this->getParams($row_key)->addColumn($name, $this->createColumn($start, $length, $type, $config));

        return $this;
    }

    /**
     * Obtem o conteudo do arquivo em uma array de array mapeado com os valores convertidos.
     * @throws Exception
     */
    public function exec(string $file_name): array
    {
        $ln = 0;
        try {
            $this->newFile($file_name);
            $result = [];
            $this->file->load();
            foreach ($this->file->getRows() as $line) {
                $ln++;
                $rv = $this->getRowValues($line);
                $result[] = $rv->parse();
            }
        } catch (DomainException $e) {
            throw new DomainException($e->getMessage() . " linha: $ln", $e->getCode(), $e);
        } catch (Exception $e) {
            throw new Exception($e->getMessage() . " linha: $ln", $e->getCode(), $e);
        }

        return $result;
    }

    /**
     * Executa o conteudo do arquivo linha por linha,
     * chamando o $onRow com array mapeado dos valores convertidos e o numero da linha.
     * @throws Exception
     */
    public function execRowByRow(string $file_name, callable $onRow): void
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
            throw new DomainException($e->getMessage() . " linha: $ln", $e->getCode(), $e);
        } catch (Exception $e) {
            throw new Exception($e->getMessage() . " linha: $ln", $e->getCode(), $e);
        }
    }

    protected function newFile(string $file_name): void
    {
        $this->file = new File($file_name);
        $this->validate();
    }

    protected function getRowValues(string $line): RowValues
    {
        $key = $this->getRowsKeyLength() ? substr($line, 0, $this->getRowsKeyLength()) : '';

        return new RowValues($this->getParams($key), $line);
    }

    /**
     * Validate rows params.
     */
    protected function validate(): void
    {
        foreach ($this->params_maps as $v) {
            $v->validate();
        }
    }
}

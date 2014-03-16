<?php

namespace Paliari\TextObject;

use DomainException;

/**
 * Class RowParams
 * @package Paliari\TextObject
 */
class RowParams
{

    protected $columns = array();

    /**
     * @param string $name
     * @param Column $column
     *
     * @return RowParams
     */
    public function addColumn($name, $column)
    {
        $this->columns[$name] = $column;

        return $this;
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Valida se as colunas estao corretas.
     *
     * @throws \DomainException
     */
    public function validate()
    {
        $old_len = 0;
        foreach ($this->getColumns() as $k => $column) {
            if ($column instanceof Column) {
                if ($column->getInit() < $old_len) {
                    throw new DomainException("Column '$k' truncada!");
                }
                $old_len = $column->getLength();
            } else {
                throw new DomainException('Column inválida!');
            }
        }
    }
}
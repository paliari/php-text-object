<?php

namespace Paliari\TextObject;
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

}
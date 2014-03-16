<?php

namespace Paliari\TextObject;

/**
 * Class RowValues
 * @package Paliari\TextObject
 */
class RowValues
{

    /**
     * Conteudo total da linha do arquivo.
     *
     * @var string
     */
    protected $content = '';

    /**
     * @var RowParams
     */
    protected $params;

    protected $values = array();

    /**
     * @param RowParams $params
     * @param string $content
     */
    public function __construct($params, $content = '')
    {
        $this->params = $params;
        $this->setContent($content);
    }

    /**
     * @return array
     */
    public function parse()
    {
        foreach ($this->params->getColumns() as $k => $column) {
            if ($column instanceof Column) {
                $this->values[$k] = $column->extractValue($this->getContent());
            }
        }

        return $this->values;
    }

    /**
     * @param string $content
     *
     * @return RowValues
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getContent();
    }

}
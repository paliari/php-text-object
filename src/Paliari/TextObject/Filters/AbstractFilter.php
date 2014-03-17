<?php

namespace Paliari\TextObject\Filters;

use DomainException;

/**
 * Class AbstractFilter
 * @package Paliari\TextObject\Filters
 */
abstract class AbstractFilter
{
    public $type = 'string';

    protected $required = false;

    protected $value;

    /**
     * Config default.
     *
     * @var array
     */
    protected $_default = array(
        'required' => false,
    );

    /**
     * @param bool|array $config
     */
    public function __construct($config = false)
    {
        if (is_bool($config)) {
            $this->required = $config;
        } elseif (is_array($config)) {
            foreach ($config as $k => $v) {
                $this->$k = $v;
            }
        }
        $this->init();
    }

    protected function init()
    {
    }

    public function validate()
    {
        if (!$this->isValid()) {
            throw new DomainException("Valor '$this->value' inválido para tipo '$this->type'!");
        }
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return !$this->required ? : (bool)$this->value;
    }

    /**
     * @return mixed
     */
    public function convert()
    {
        $this->validate();

        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function __invoke($value)
    {
        $this->value = $value;

        return $this->convert();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->convert();
    }

}
<?php

namespace Paliari\TextObject\Filters;

use DomainException;

/**
 * Class AbstractFilter
 * @package Paliari\TextObject\Filters
 */
abstract class AbstractFilter implements FilterInterface
{
    public string $type = Types::STRING;

    protected bool $required = false;

    protected mixed $value = '';

    public function __construct(bool|array $config = false)
    {
        if (is_bool($config)) {
            $this->required = $config;
        } elseif (is_array($config)) {
            $vars = get_object_vars($this);
            unset($vars['type']);
            $config = array_intersect_key($config, $vars);
            foreach ($config as $k => $v) {
                $this->$k = $v;
            }
        }
        $this->init();
    }

    protected function init(): void
    {
    }

    public function __invoke(?string $value): mixed
    {
        $this->value = $value;

        return $this->convert();
    }

    /**
     * @return mixed
     */
    public function convert(): mixed
    {
        $this->validate();

        return $this->value;
    }

    public function validate(): void
    {
        if (!$this->isValid()) {
            throw new DomainException("Valor '$this->value' inválido para tipo '$this->type'!");
        }
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return !$this->required || $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->convert();
    }
}

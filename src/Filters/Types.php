<?php

namespace Paliari\TextObject\Filters;

use DomainException;

/**
 * Class Types
 * @package Paliari\TextObject\Filters
 */
class Types
{
    const DATE_TIME     = 'datetime';
    const DOUBLE        = 'double';
    const EMAIL         = 'email';
    const INT           = 'int';
    const INT_2_DOUBLE  = 'int_2_double';
    const NUMBER_STRING = 'number_string';
    const STRING        = 'string';
    const BOOL          = 'bool';

    /**
     * Mapa de tipos suportados.
     *
     * @var array
     */
    protected static $_typesMap = [
        self::DATE_TIME     => 'Paliari\TextObject\Filters\FDateTime',
        self::DOUBLE        => 'Paliari\TextObject\Filters\FDouble',
        self::EMAIL         => 'Paliari\TextObject\Filters\FEmail',
        self::INT           => 'Paliari\TextObject\Filters\FInt',
        self::INT_2_DOUBLE  => 'Paliari\TextObject\Filters\FInt2Double',
        self::NUMBER_STRING => 'Paliari\TextObject\Filters\FNumberString',
        self::STRING        => 'Paliari\TextObject\Filters\FString',
        self::BOOL          => 'Paliari\TextObject\Filters\FBool',
    ];

    /**
     * @var array
     */
    protected static $_typeObjects = [];

    /**
     * @param string $name
     * @param bool   $config
     *
     * @return AbstractFilter
     * @throws DomainException
     */
    public static function getType($name, $config = false)
    {
        $key = $name;
        if (is_array($config)) {
            foreach ($config as $k => $v) {
                $key .= "$k:$v";
            }
        } else {
            $key .= $config;
        };
        if (!isset(self::$_typeObjects[$key])) {
            if (!isset(self::$_typesMap[$name])) {
                throw new DomainException("Type '$name' not found!");
            }
            self::$_typeObjects[$key] = new self::$_typesMap[$name]($config);
        }

        return self::$_typeObjects[$key];
    }

    /**
     * Adds a custom type to the type map.
     *
     * @static
     *
     * @param string $name Name of the type.
     * @param string $className The class name of the custom type.
     *
     * @throws DomainException
     */
    public static function addType($name, $className)
    {
        if (isset(self::$_typesMap[$name])) {
            throw new DomainException("Type '$name' já existe!");
        }
        self::$_typesMap[$name] = $className;
    }

    /**
     * Checks if exists support for a type.
     *
     * @static
     *
     * @param string $name Name of the type
     *
     * @return boolean TRUE if type is supported; FALSE otherwise
     */
    public static function hasType($name)
    {
        return isset(self::$_typesMap[$name]);
    }

    /**
     * Obtem os types mapeados.
     *
     * @return array
     */
    public static function getTypes()
    {
        return self::$_typesMap;
    }
}

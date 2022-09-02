<?php

namespace Paliari\TextObject\Filters;

use DomainException;

/**
 * Class Types
 * @package Paliari\TextObject\Filters
 */
class Types
{
    public const DATE_TIME = 'datetime';
    public const DOUBLE = 'double';
    public const EMAIL = 'email';
    public const INT = 'int';
    public const INT_2_DOUBLE = 'int_2_double';
    public const NUMBER_STRING = 'number_string';
    public const STRING = 'string';
    public const BOOL = 'bool';

    protected static array $typesMap = [
        self::DATE_TIME => FDateTime::class,
        self::DOUBLE => FDouble::class,
        self::EMAIL => FEmail::class,
        self::INT => FInt::class,
        self::INT_2_DOUBLE => FInt2Double::class,
        self::NUMBER_STRING => FNumberString::class,
        self::STRING => FString::class,
        self::BOOL => FBool::class,
    ];

    protected static array $_typeObjects = [];

    /**
     * @throws DomainException
     */
    public static function getType(string $name, $config = false): FilterInterface
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
            if (!isset(self::$typesMap[$name])) {
                throw new DomainException("Type '$name' not found!");
            }
            self::$_typeObjects[$key] = new self::$typesMap[$name]($config);
        }

        return self::$_typeObjects[$key];
    }

    /**
     * @throws DomainException
     */
    public static function addType(string $name, string $className): void
    {
        if (isset(self::$typesMap[$name])) {
            throw new DomainException("Type '$name' já existe!");
        }
        self::$typesMap[$name] = $className;
    }

    public static function hasType(string $name): bool
    {
        return isset(self::$typesMap[$name]);
    }

    public static function getTypes(): array
    {
        return self::$typesMap;
    }
}

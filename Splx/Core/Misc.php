<?php

namespace Splx\Core;

/**
 * Class Misc
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splextend
 */
class Misc
{
    /**
     * @param $string
     * @return array|string|string[]|null
     */
    public static function toSnakeCase($string)
    {
        Assert::validateInstance($string, 'string');

        return preg_replace_callback('/([a-z])([A-Z])/', function ($match) {
            return $match[1] . '_' . strtolower($match[2]);
        }, $string);
    }

    /**
     * @param $string
     * @return array|string|string[]|null
     */
    public static function toCamelCase($string)
    {
        Assert::validateInstance($string, 'string');

        return preg_replace_callback('/([a-z])_([a-z])/', function ($match) {
            return $match[1] . strtoupper($match[2]);
        }, $string);
    }
}

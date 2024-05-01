<?php

namespace Splx\Core;

/**
 * Class Misc
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Misc
{
    /**
     * @param $camelCaseString
     * @return array|string|string[]|null
     */
    public static function toSnakeCase($camelCaseString)
    {
        Assert::validateInstance($camelCaseString, 'string');

        return preg_replace_callback('/([a-z])([A-Z])/', function ($match) {
            return $match[1] . '_' . strtolower($match[2]);
        }, $camelCaseString);
    }

    /**
     * @param $snakeCaseString
     * @return array|string|string[]|null
     */
    public static function toCamelCase($snakeCaseString)
    {
        Assert::validateInstance($snakeCaseString, 'string');

        return preg_replace_callback('/([a-z])_([a-z])/', function ($match) {
            return $match[1] . strtoupper($match[2]);
        }, $snakeCaseString);
    }

    /**
     * @param $snakeCaseString
     * @return array|string|string[]|null
     */
    public static function toTrainCase($snakeCaseString)
    {
        Assert::validateInstance($snakeCaseString, 'string');

        $snakeCaseString = ucfirst($snakeCaseString);

        return preg_replace_callback('/([a-z])_([a-z])/', function ($match) {
            return $match[1] . '-' . strtoupper($match[2]);
        }, $snakeCaseString);
    }
}

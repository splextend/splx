<?php

namespace Splx\Core;

/**
 * Class Assert
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Assert
{
    /**
     * @param $expect
     * @param $message
     * @param $code
     * @param $class
     * @return void
     */
    public static function throwIfFalse($expect, $message = '', $code = 0, $class = 'UnexpectedValueException')
    {
        if (!$expect) {
            throw new $class(
                $message,
                $code
            );
        }
    }

    /**
     * @param $expect
     * @param $message
     * @param $code
     * @param $class
     * @return void
     */
    public static function throwLastErrorIfFalse($expect, $message = '', $code = 0, $class = 'UnexpectedValueException')
    {
        if (!$expect) {
            $lastError = error_get_last();

            if (!$lastError) {
                $lastError = array (
                    'message' => $message,
                    'type'    => $code
                );
            }

            throw new $class(
                $lastError['message'],
                $lastError['type']
            );
        }
    }

    /**
     * @param $instance
     * @param $types
     * @param $class
     * @return true
     */
    public static function validateInstance($instance, $types, $class = 'UnexpectedValueException')
    {
        $types = (array) $types;

        $calculatedType = gettype($instance);

        if (in_array($calculatedType, $types)) {
            return true;
        }

        if (is_resource($instance) and in_array(get_resource_type($instance), $types)) {
            return true;
        }

        if (is_object($instance)) {
            foreach ($types as $type) {
                if (is_a($instance, $type)) {
                    return true;
                }
            }
        }

        throw new $class(
            sprintf(
                "'%s', %s",
                $calculatedType,
                "['" . implode("','", $types) . "']"
            )
        );
    }
}

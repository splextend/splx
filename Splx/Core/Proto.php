<?php

namespace Splx\Core;

/**
 * Class Proto
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
abstract class Proto
{
    /**
     * @param $value
     * @return mixed
     */
    public static function safeValue($value)
    {
        if ($value instanceof Proto) {
            return $value->valueOf();
        }

        return $value;
    }

    /**
     * @return mixed
     */
    abstract public function valueOf();
}

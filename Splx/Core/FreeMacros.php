<?php

namespace Splx\Core;

/**
 * Class FreeMacros
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class FreeMacros extends Macros
{
    /**
     * @param $key
     * @return true
     */
    public function has($key)
    {
        return true;
    }
}

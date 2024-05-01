<?php

namespace Splx\Core\Traits;

/**
 * Trait ArrayIterator
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
trait ArrayIterator
{
    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->storage);
    }
}

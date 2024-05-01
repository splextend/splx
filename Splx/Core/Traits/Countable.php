<?php

namespace Splx\Core\Traits;

/**
 * Trait Countable
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
trait Countable
{
    /**
     * @return int
     */
    public function count()
    {
        return count($this->storage);
    }
}

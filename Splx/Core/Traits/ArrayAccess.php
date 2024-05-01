<?php

namespace Splx\Core\Traits;

/**
 * Trait ArrayAccess
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
trait ArrayAccess
{
    /**
     * @param $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * @param $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->del($key);
    }
}

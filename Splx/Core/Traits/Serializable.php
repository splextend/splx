<?php

namespace Splx\Core\Traits;

use Splx\Core\Assert;

/**
 * Trait Serializable
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
trait Serializable
{

    /**
     * @return string|null
     */
    public function serialize()
    {
        return serialize($this->storage);
    }

    /**
     * @param $data
     * @return void
     */
    public function unserialize($data)
    {
        $unserialize = unserialize($data);

        Assert::throwIfFalse(
            $unserialize,
            'Cannot unserialize given value'
        );

        $this->storage = $unserialize;
    }
}

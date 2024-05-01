<?php

namespace Splx\IO;

/**
 * Class Memory
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Memory extends File
{
    public function __construct($mode = 'rw+')
    {
        $resource = self::__callStatic('open',['php://memory', $mode]);
        $this->setResource($resource);
    }
}

<?php

namespace Splx\IO;

/**
 * Class Temp
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Temp extends File
{
    public function __construct($mode = 'rw+', $maxmemory = 522240)
    {
        $resource = self::__callStatic('open',['php://temp/maxmemory:' . $maxmemory, $mode]);
        $this->setResource($resource);
    }
}

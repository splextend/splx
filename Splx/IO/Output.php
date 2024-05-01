<?php

namespace Splx\IO;

/**
 * Class Output
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Output extends File
{
    public function __construct()
    {
        $resource = self::__callStatic('open',['php://output', 'w']);
        $this->setResource($resource);
    }
}

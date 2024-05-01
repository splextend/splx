<?php

namespace Splx\IO;

/**
 * Class Input
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Input extends File
{
    public function __construct()
    {
        $resource = self::__callStatic('open',['php://input', 'r']);
        $this->setResource($resource);
    }
}

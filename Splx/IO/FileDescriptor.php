<?php

namespace Splx\IO;

/**
 * Class FileDescriptor
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class FileDescriptor extends File
{
    public function __construct($descriptor, $mode)
    {
        $resource = self::__callStatic('open', ['php://fd/' . $descriptor, $mode]);
        $this->setResource($resource);
    }
}

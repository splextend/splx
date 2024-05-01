<?php

namespace Splx\IO;

/**
 * Class Stderr
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Stderr extends File
{
    public function __construct()
    {
        $this->setResource(STDERR);
    }
}

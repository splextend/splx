<?php

namespace Splx\IO;

/**
 * Class Stdout
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Stdout extends File
{
    public function __construct()
    {
        $this->setResource(STDOUT);
    }
}

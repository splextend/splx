<?php

namespace Splx\IO;

use Splx\IO\File;

/**
 * Class Stdin
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Stdin extends File
{
    public function __construct()
    {
        $this->setResource(STDIN);
    }
}

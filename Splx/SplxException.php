<?php

namespace Splx;

use Exception;

/**
 * Class SpxException
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class SplxException extends Exception
{
    /**
     * @param string $file
     * @return void
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @param int $line
     * @return void
     */
    public function setLine($line)
    {
        $this->line = $line;
    }
}

<?php

namespace Splx\Stream;

use php_user_filter;
use Splx\IO\Stream;

/**
 * Class StreamContext
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splextend
 */

abstract class StreamFilter extends php_user_filter
{
    public function onCreate()
    {

    }

    public function onClose()
    {

    }

    public function filter($in, $out, &$consumed, $closing)
    {
        $this->handle(
            Stream::createFromResource($in),
            Stream::createFromResource($out),

            $closing
        );
    }

    public function getFilterName()
    {
        return $this->filtername;
    }

    abstract function handle(Stream $inputStream, Stream $outputStream);
}

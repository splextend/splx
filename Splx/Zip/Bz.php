<?php

namespace Splx\Zip;

use Splx\Resource\AbstractResource;

/**
 * Class Bz
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method flush()
 * @method read($length)
 * @method write($str, $length)
 * @method close()
 * @method errno()
 * @method error()
 * @method errstr()
 * @method static compress($source, $blocksize, $workfactor)
 * @method static decompress($source, $small)
*/
class Bz extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'bz';

    /**
     * @var string[]
     */
    protected static $functions = [
        'bzflush',
        'bzread',
        'bzwrite',
        'bzopen',
        'bzclose',
        'bzerrno',
        'bzerror',
        'bzerrstr'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'bzcompress',
        'bzdecompress'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'bzopen',
        'bzdecompress',
        'bzflush',
        'bzread',
        'bzwrite'
    ];

    /**
     * @param $file
     * @param $mode
     */
    public function __construct($file, $mode)
    {
        $resource = $this->open($file, $mode);

        $this->setResource($resource);
    }

    public function __destruct()
    {
        $this->close();
    }
}

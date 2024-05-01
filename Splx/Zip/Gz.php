<?php

namespace Splx\Zip;

use Splx\Resource\AbstractResource;

/**
 * Class Gz
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method close()
 * @method eof()
 * @method getc()
 * @method gets($length)
 * @method getss($length, $allowableTags)
 * @method passthru()
 * @method puts($str, $length)
 * @method read($length)
 * @method rewind()
 * @method seek($offset, $whence)
 * @method tell()
 * @method write($str, $length)
 * @method static readgzfile($filename, $useIncludePath)
 * @method static compress($data, $level, $encoding)
 * @method static uncompress($data, $maxDecodedLen)
 * @method static decode($data, $maxDecodedLen)
 * @method static deflate($data, $level, $encoding)
 * @method static encode($data, $level, $encoding)
 * @method static inflate($data, $maxDecodedLen)
 * @method static file($filename, $useIncludePath)
*/
class Gz extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'gz';

    /**
     * @var string[]
     */
    protected static $functions = [
        'gzclose',
        'gzeof',
        'gzgetc',
        'gzgets',
        'gzgetss',
        'gzopen',
        'gzpassthru',
        'gzputs',
        'gzread',
        'gzrewind',
        'gzseek',
        'gztell',
        'gzwrite'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'readgzfile',
        'gzcompress',
        'gzuncompress',
        'gzdecode',
        'gzdeflate',
        'gzencode',
        'gzinflate',
        'gzfile',
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'gzcompress',
        'gzuncompress',
        'gzdecode',
        'gzdeflate',
        'gzencode',
        'gzinflate',
        'gzfile',
        'gzgets',
        'gzgetss',
        'gzopen',
        'gzputs',
        'gzread',
        'gzrewind',
        'gzwrite',
        'gztell'
    ];

    /**
     * @var string[]
     */
    protected static $selfReturnMethods = [
        'gzrewind'
    ];

    /**
     * @param $filename
     * @param $mode
     * @param $useIncludePath
     */
    public function __construct($filename, $mode, $useIncludePath = 0)
    {
        $resource = $this->open(
            $filename,
            $mode,
            $useIncludePath
        );

        $this->setResource($resource);
    }

    public function __destruct()
    {
        $this->close();
    }
}

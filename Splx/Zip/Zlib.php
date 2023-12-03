<?php

namespace Splx\Zip;

use Splx\Resource\AbstractResource;

/**
 * Class Zlib
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method static decode($data, $maxDecodedLen)
 * @method static encode($data, $encoding, $level)
 * @method static getCodingType()
 */
class Zlib extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'zlib_';

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'zlib_decode',
        'zlib_encode',
        'zlib_get_coding_type'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'zlib_decode',
        'zlib_encode'
    ];
}

<?php

namespace Splx\IO;

use Splx\Resource\AbstractResource;

/**
 * Class Curl
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method close()
 * @method init()
 * @method copyHandle()
 * @method errno()
 * @method error()
 * @method escape($str)
 * @method exec()
 * @method getinfo($option)
 * @method pause($bitmask)
 * @method reset()
 * @method setoptArray(array $options)
 * @method setopt($option, $value)
 * @method unescape($str)
 * @method upkeep()
 * @method static version($version)
 * @method static strerror($errornum)
 */
class Curl extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'curl_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'curl_close',
        'curl_init',
        'curl_copy_handle',
        'curl_errno',
        'curl_error',
        'curl_escape',
        'curl_exec',
        'curl_getinfo',
        'curl_pause',
        'curl_reset',
        'curl_setopt_array',
        'curl_setopt',
        'curl_unescape',
        'curl_upkeep'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'curl_version',
        'curl_strerror'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'curl_init',
        'curl_copy_handle',
        'curl_escape',
        'curl_exec',
        'curl_getinfo',
        'curl_setopt_array',
        'curl_setopt',
        'curl_unescape',
        'curl_upkeep'
    ];

    /**
     * @var string[]
     */
    protected static $selfInstanceMethod = [
        'curl_copy_handle'
    ];

    /**
     * @param $url
     */
    public function __construct($url = null)
    {
        $resource = $this->init($url);

        $this->setResource($resource, ['resource', 'CurlHandle']);
    }

    public function __destruct()
    {
        $this->close();
    }
}

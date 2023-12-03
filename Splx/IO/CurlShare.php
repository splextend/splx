<?php

namespace Splx\IO;

use Splx\Resource\AbstractResource;

/**
 * Class CurlShare
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method close()
 * @method errno()
 * @method init()
 * @method setopt($option, $value)
 * @method static strerror($errornum)
 */
class CurlShare extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'curl_share_';

    /**
     * @var array
     */
    protected static $functions = [
        'curl_share_close',
        'curl_share_errno',
        'curl_share_init',
        'curl_share_setopt'
    ];

    /**
     * @var array
     */
    protected static $staticFunctions = [
        'curl_share_strerror'
    ];

    /**
     * @var array
     */
    protected static $watchFalseFunctions = [
        'curl_share_setopt'
    ];

    public function __construct()
    {
        $resource = $this->init();

        $this->setResource($resource, ['resource', 'CurlShareHandle']);
    }

    public function __destruct()
    {
        $this->close();
    }
}

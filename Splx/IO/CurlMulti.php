<?php

namespace Splx\IO;

use Splx\Resource\AbstractResource;

/**
 * Class CurlMulti
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method addHandle($ch)
 * @method close()
 * @method errno()
 * @method exec(&$stillRunning)
 * @method getcontent()
 * @method infoRead(&$msgsInQueue)
 * @method init()
 * @method removeHandle($ch)
 * @method select($timeout)
 * @method setopt($option, $value)
 * @method static strerror($errornum)
 */
class CurlMulti extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'curl_multi_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'curl_multi_add_handle',
        'curl_multi_close',
        'curl_multi_errno',
        'curl_multi_exec',
        'curl_multi_getcontent',
        'curl_multi_info_read',
        'curl_multi_init',
        'curl_multi_remove_handle',
        'curl_multi_select',
        'curl_multi_setopt'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'curl_multi_strerror'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'curl_multi_info_read',
        'curl_multi_setopt'
    ];

    public function __construct()
    {
        $resource = $this->init();

        $this->setResource($resource, ['resource', 'CurlMultiHandle']);
    }

    public function __destruct()
    {
        $this->close();
    }
}

<?php

namespace Splx\System;

use Splx\Resource\AbstractResource;

/**
 * Class Msg
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method queueExists()
 * @method receive()
 * @method removeQueue()
 * @method send()
 * @method setQueue()
 * @method statQueue()
 * @method static queueExists()
 */
class Msg extends AbstractResource
{
    protected static $prefix = 'msg_';

    protected static $functions = [
        'msg_queue_exists',
        'msg_receive',
        'msg_remove_queue',
        'msg_send',
        'msg_set_queue',
        'msg_stat_queue'
    ];

    protected static $staticFunctions = [
        'msg_get_queue',
        'msg_queue_exists'
    ];

    protected static $watchFalseFunctions = [
        'msg_get_queue',
        'msg_queue_exists',
        'msg_receive',
        'msg_remove_queue',
        'msg_send',
        'msg_set_queue',
        'msg_stat_queue'
    ];

    public function __construct($key, $permissions = 0666)
    {
        $resource = self::__callStatic(
            'getQueue',
            [
                $key,
                $permissions
            ]
        );

        $this->setResource($resource, ['resource', 'SysvMessageQueue']);
    }
}

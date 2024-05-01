<?php

namespace Splx\System;

use Splx\Resource\AbstractResource;

/**
 * Class Shmop
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method delete()
 * @method open()
 * @method read()
 * @method size()
 * @method write()
 */
class Shmop extends AbstractResource
{
    protected static $prefix = 'shmop_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'shmop_close',
        'shmop_delete',
        'shmop_open',
        'shmop_read',
        'shmop_size',
        'shmop_write'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'shmop_open'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'shmop_delete',
        'shmop_open',
        'shmop_read',
        'shmop_write'
    ];

    /**
     * @param $key
     * @param $mode
     * @param $permissions
     * @param $size
     */
    public function __construct($key, $mode, $permissions, $size)
    {
        $resource = self::__callStatic(
            'open',
            [
                $key,
                $mode,
                $permissions,
                $size
            ]
        );

        $this->setResource($resource, ['resource', 'Shmop']);
    }

    public function __destruct()
    {
        if (function_exists('shmop_close')) {
            $this->close();
        }
    }
}
<?php

namespace Splx\System;

use Splx\Resource\AbstractResource;

/**
 * Class Sem
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method acquire()
 * @method release()
 * @method remove()
 */
class Sem extends AbstractResource
{
    protected static $prefix = 'sem_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'sem_acquire',
        'sem_release',
        'sem_remove'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'sem_get'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'sem_get',
        'sem_acquire',
        'sem_release',
        'sem_remove'
    ];

    public function __construct($key, $max_acquire = 1, $permissions = 0666, $auto_release = true)
    {
        $resource = self::__callStatic(
            'get',
            [
                $key,
                $max_acquire,
                $permissions,
                $auto_release
            ]
        );

        $this->setResource($resource, ['resource', 'SysvSemaphore']);
    }
}

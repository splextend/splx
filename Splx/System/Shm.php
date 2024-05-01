<?php

namespace Splx\System;

use Splx\Resource\AbstractResource;

/**
 * Class Shm
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method detach()
 * @method getVar()
 * @method hasVar()
 * @method putVar()
 * @method removeVar()
 * @method remove()
 */
class Shm extends AbstractResource
{
    protected static $prefix = 'shm_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'shm_detach',
        'shm_get_var',
        'shm_has_var',
        'shm_put_var',
        'shm_remove_var',
        'shm_remove'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'shm_attach'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'shm_detach',
        'shm_get_var',
        'shm_put_var',
        'shm_remove_var',
        'shm_remove',
    ];

    public function __construct($key, $size = null, $permissions = 0666)
    {
        $resource = self::__callStatic(
            'attach',
            [
                $key,
                $size,
                $permissions
            ]
        );

        $this->setResource($resource, ['resource', 'SysvSharedMemory']);
    }
}

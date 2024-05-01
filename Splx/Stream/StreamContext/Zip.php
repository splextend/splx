<?php

namespace Splx\Stream\StreamContext;

/**
 * Class Zip
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method getPassword()
 * @method self setPassword($value)
 * @method delPassword()
 */
class Zip extends AbstractContext
{
    /**
     * @var string[]
     */
    protected $keys = [
        'password'
    ];
}

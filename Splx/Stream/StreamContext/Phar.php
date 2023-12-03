<?php

namespace Splx\Stream\StreamContext;

/**
 * Class Phar
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method getCompress()
 * @method getMetadata()
 * @method self setCompress($value)
 * @method self setMetadata($value)
 * @method delCompress()
 * @method delMetadata()
 */
class Phar extends AbstractContext
{
    /**
     * @var string[]
     */
    protected $keys = [
        'compress',
        'metadata'
    ];
}

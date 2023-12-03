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
 * @method getLevel()
 * @method self setLevel($value)
 * @method delLevel()
 */
class Zlib extends AbstractContext
{
    /**
     * @var string[]
     */
    protected $keys = [
        'level'
    ];
}

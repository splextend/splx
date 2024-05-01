<?php

namespace Splx\Zip;

use Splx\Resource\AbstractResource;

/**
 * Class Deflate
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method add($add, $flushBehavior)
 * @method init($level)
 */
class Deflate extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'deflate_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'deflate_add',
        'deflate_init'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'deflate_add',
        'deflate_init'
    ];

    /**
     * @param $encoding
     * @param array $options
     */
    public function __construct($encoding, array $options = [])
    {
        $resource = $this->init($encoding, $options);

        $this->setResource($resource, ['resource', ' DeflateContext']);
    }
}

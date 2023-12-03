<?php

namespace Splx\Zip;

use Splx\Resource\AbstractResource;

/**
 * Class Inflate
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method add($encodedData, $flushMode)
 * @method init($options)
 * @method getReadLen()
 * @method getStatus()
 */
class Inflate extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'inflate_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'inflate_add',
        'inflate_init',
        'inflate_get_read_len',
        'inflate_get_status'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'inflate_add',
        'inflate_init',
        'inflate_get_read_len'
    ];

    /**
     * @param $encoding
     * @param array $options
     */
    public function __construct($encoding, array $options = [])
    {
        $resource = $this->init($encoding, $options);

        $this->setResource($resource, ['resource', ' InflateContext']);
    }
}

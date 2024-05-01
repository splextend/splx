<?php

namespace Splx\Xml;

use Splx\Resource\AbstractResource;

/**
 * Class XmlParser
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method free()
 * @method getOption($option)
 * @method setOption($option, $value)
 */
class XmlParser extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'xml_parser_';

    /**
     * @var array
     */
    protected static $functions = [
        'xml_parser_free',
        'xml_parser_get_option',
        'xml_parser_set_option'
    ];

    /**
     * @var array
     */
    protected static $staticFunctions = [
        'xml_parser_create',
        'xml_parser_create_ns',
    ];

    /**
     * @var array
     */
    protected static $watchFalseFunctions = [
        'xml_parser_create',
        'xml_parser_create_ns',
        'xml_parser_get_option',
        'xml_parser_set_option'
    ];

    private function __construct($resource)
    {
        $this->setResource($resource, ['resource', 'XMLParser']);
    }

    public static function create($encoding = null)
    {
        $resource = self::__callStatic('create', [$encoding]);

        return new self($resource);
    }

    public static function createNs($encoding = null, $separator = ":")
    {
        $resource = self::__callStatic('createNs', [$encoding, $separator]);

        return new self($resource);
    }

    public function __destruct()
    {
        $this->free();
    }
}

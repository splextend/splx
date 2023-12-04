<?php

namespace Splx\Xml;

use Splx\Resource\AbstractResource;

/**
 * Class Xml
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method getCurrentByteIndex()
 * @method getCurrentColumnNumber()
 * @method getCurrentLineNumber()
 * @method getErrorCode()
 * @method parseIntoStruct($data, &$values, &$index = null)
 * @method parse($data, $isfinal = false)
 * @method setCharacterDataHandler($hdl)
 * @method setDefaultHandler($hdl)
 * @method setElementHandler($shdl, $ehdl)
 * @method setEndNamespaceDeclHandler($hdl)
 * @method setExternalEntityRefHandler($hdl)
 * @method setNotationDeclHandler($hdl)
 * @method setObject($obj)
 * @method setProcessingInstructionHandler($hdl)
 * @method setStartNamespaceDeclHandler($hdl)
 * @method setUnparsedEntityDeclHandler($hdl)
 * @method static errorString($code)
 */
class Xml extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'xml_';

    /**
     * @var array
     */
    protected static $functions = [
        'xml_get_current_byte_index',
        'xml_get_current_column_number',
        'xml_get_current_line_number',
        'xml_get_error_code',
        'xml_parse_into_struct',
        'xml_parse',
        'xml_set_character_data_handler',
        'xml_set_default_handler',
        'xml_set_element_handler',
        'xml_set_end_namespace_decl_handler',
        'xml_set_external_entity_ref_handler',
        'xml_set_notation_decl_handler',
        'xml_set_object',
        'xml_set_processing_instruction_handler',
        'xml_set_start_namespace_decl_handler',
        'xml_set_unparsed_entity_decl_handler'
    ];

    /**
     * @var array
     */
    protected static $staticFunctions = [
        'xml_error_string'
    ];

    public function __construct(XmlParser $xmlParser)
    {
        $this->setResource(
            $xmlParser->valueOf(),
            ['resource', 'XMLParser']
        );
    }
}

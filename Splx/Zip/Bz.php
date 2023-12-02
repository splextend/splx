<?php
namespace PHP\Lang;

use http\Exception\UnexpectedValueException;

class Bz extends AbstractResource
{
	protected static $prefix = 'bz';

    protected static $functions = array(
    	'bzflush',
    	'bzread',
    	'bzwrite',
        'bzclose'
    );

    protected static $staticFunctions = array(
    	'bzcompress',
    	'bzdecompress'
    );

    public function __construct($file, $mode)
    {
    	$file = self::safeValue($file);

    	$resource = bzopen($file, $mode);
    	if (false === $resource) {
            throw new UnexpectedValueException(

            );
    	}

        $this->setResource($resource);
    }

    public function __destruct()
    {
    	$this->close();
    }
}

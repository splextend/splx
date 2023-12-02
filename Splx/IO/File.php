<?php
namespace Splx\IO;

use Splx\Resource\AbstractResource;

class File extends AbstractResource
{
    const READ = 'r';

    const WRITE = 'w';
    const READ_BINARY = 'rb';
    const WRITE_BINARY = 'wb';

	protected static $prefix = 'f';

    protected static $functions = array(
		'fclose',
		'feof',
		'fflush',
		'fgetc',
		'fgetcsv',
		'fgets',
		'fgetss',
		'flock',
		'fpassthru',
		'fputcsv',
		'fputs',
		'fread',
		'fscanf',
		'fseek',
		'fstat',
		'ftell',
		'ftruncate',
		'fwrite'
	);

    protected static $staticFunctions = array();

    /**
     * @return self
     * @throws ResourceException
     */
    public static function tmp()
    {
        $instance = new static;
        $instance->setResource(@tmpfile());

        return $instance;
    }
	public static function open($filename, $mode = self::READ_BINARY, StreamContext $context = null, $useIncludePath = false)
	{
		if ($context) {
			$context = $context->valueOf();
		}

        $instance = new static;
		$instance->setResource(@fopen($filename, $mode, $useIncludePath, $context));

        return $instance;
	}

	public function __destruct()
	{
		$this->close();
	}
}
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
        'fdatasync',
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
		'fwrite',
        'rewind'
	);

    protected static $staticFunctions = [
        'tmpfile',
        'tempnam',
        'fopen',
    ];

    protected static $watchFalseFunctions = [
        'tmpfile',
        'tempnam',
        'fopen',
        'fgets'
    ];

    /**
     * @return self
     * @throws ResourceException
     */
    public static function tmpfile()
    {
        $resource = self::__callStatic('tmpfile');

        $instance = new static;
        $instance->setResource($resource);

        return $instance;
    }

    public static function tempnam($directory, $prefix = null)
    {
        if (func_num_args() === 1 and null === $prefix) {
            $prefix = array_merge(range('A','Z'), range('a', 'z'), range('0', '9'));
            $prefix = implode($prefix);
            $prefix = str_shuffle($prefix);
            $prefix = substr($prefix, 0, 8);
        }

        $filename = self::__callStatic('tempnam', [$directory, $prefix]);

        return $filename;
    }

	public static function open($filename, $mode = self::READ_BINARY, StreamContext $context = null, $useIncludePath = false)
	{
        $resource = self::__callStatic(
            'fopen',
            [$filename, $mode, $useIncludePath, $context]
        );

        $instance = new static;
		$instance->setResource($resource);

        return $instance;
	}

	public function __destruct()
	{
        if ('Unknown' !== get_resource_type($this->resource)){
            $this->close();
        }
	}
}

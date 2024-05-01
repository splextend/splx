<?php

namespace Splx\IO;

use Splx\Resource\AbstractResource;

class File extends AbstractResource
{
    /**
     * @var string
     */
	protected static $prefix = 'f';

    /**
     * @var string[]
     */
    protected static $functions = [
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
	];

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

    public static function tempnam($directory = null, $prefix = null)
    {
        if (func_num_args() === 0 and null === $directory) {
            $directory = sys_get_temp_dir();
        }

        if (func_num_args() === 1 and null === $prefix) {
            $prefix = array_merge(range('A','Z'), range('a', 'z'), range('0', '9'));
            $prefix = implode($prefix);
            $prefix = str_shuffle($prefix);
            $prefix = substr($prefix, 0, 8);
        }

        return self::__callStatic('tempnam', [$directory, $prefix]);
    }

	public function __construct($filename, $mode = 'r', StreamContext $context = null, $useIncludePath = false)
	{
        $resource = self::__callStatic(
            'fopen',
            [$filename, $mode, $useIncludePath, $context]
        );

		$this->setResource($resource);
	}

	public function __destruct()
	{
        if ('Unknown' !== get_resource_type($this->resource)){
            $this->close();
        }
	}
}

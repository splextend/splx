<?php

namespace Splx\System;

use Splx\IO\File;
use Splx\Resource\AbstractResource;

/**
 * Class Proc
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method getStatus()
 * @method nice()
 * @method terminate($signal = 15)
 */
class Proc extends AbstractResource
{
    /**
     * @var File
     */
    protected $inputStream;

    /**
     * @var File
     */
    protected $outputStream;

    /**
     * @var File
     */
    protected $errorStream;

    /**
     * @var string
     */
    protected static $prefix = 'proc_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'proc_close',
        'proc_get_status',
        'proc_nice',
        'proc_terminate'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'proc_open'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'proc_nice',
        'proc_open'
    ];

    public function __construct($command, $cwd = null, array $envVars = null, array $options = null)
    {
        $pipes = [];
        $descriptorSpec = [
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("pipe", "r")
        ];

        $resource = self::__callStatic(
            'open',
            [
                $command,
                $descriptorSpec,
                &$pipes,
                $cwd,
                $envVars,
                $options
            ]
        );

        $this->setResource($resource);

        list($input, $output, $error) = $pipes;

        $this->inputStream  = File::createFromResource($input);
        $this->outputStream = File::createFromResource($output);
        $this->errorStream  = File::createFromResource($error);
    }

    public function getInputStream()
    {
        return $this->inputStream;
    }

    public function getOutputStream()
    {
        return $this->outputStream;
    }

    public function getErrorStream()
    {
        return $this->errorStream;
    }

    public function __destruct()
    {
        $this->close();
    }
}

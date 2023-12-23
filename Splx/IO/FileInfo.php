<?php

namespace Splx\IO;

use UnexpectedValueException;
use Splx\Resource\AbstractResource;

class FileInfo extends AbstractResource
{
    protected static $prefix = 'file';

    /**
     * @var string[]
     */
    protected static $functions = [
        'basename',
        'dirname',
        'fileatime',
        'filectime',
        'filegroup',
        'fileinode',
        'filemtime',
        'fileowner',
        'fileperms',
        'filesize',
        'filetype',
        'is_dir',
        'is_executable',
        'is_file',
        'is_link',
        'is_readable',
        'is_writable',
    ];

    protected static $watchFalseFunctions = [
        'fileatime',
        'filectime',
        'filegroup',
        'fileinode',
        'filemtime',
        'fileowner',
        'fileperms',
        'filesize',
        'filetype'
    ];

    public function __construct($filepath)
    {
        if (realpath($filepath) and (is_file($filepath) or is_dir($filepath))) {
            $this->setResource($filepath, 'string');
        }

        throw new UnexpectedValueException(
            sprintf(
                "The specified path '%s' does not exist or is not a file type",
                $filepath
            )
        );
    }

    //md5_file
    //sha1_file
}

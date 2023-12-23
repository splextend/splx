<?php

namespace Splx\IO;

use UnexpectedValueException;
use Splx\Resource\AbstractResource;

class FileAction extends AbstractResource
{
    protected static $functions = [
        'chmod',
        'chown',
        'copy',
        'rename',
        'symlink',
        'link',
        'touch',
        'unlink'
    ];

    protected static $watchFalseFunctions = [
        'chmod',
        'chown',
        'copy',
        'rename',
        'symlink',
        'link',
        'touch',
        'unlink'
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
}

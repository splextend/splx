<?php

namespace Splx\Http;

use RuntimeException;
use Splx\Core\Assert;
use Splx\Core\ReadonlyMacros;

class UploadFile extends ReadonlyMacros
{
    protected $keys = [
        'name',
        'type',
        'size',
        'error',
        'tmp_name'
    ];

    public function hasError()
    {
        return $this->getError() > 0;
    }

    public function getErrorMessage()
    {
        $error = $this->getError();

        if (!$error) {
            return;
        }

        static $uploadErrors = [
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk.',
            8 => 'A PHP extension stopped the file upload.',
        ];

        return (
            isset($uploadErrors[$error])
            ? $uploadErrors[$error]
            : 'Unknown file upload error'
        );
    }

    public function moveUploadedFile($dest)
    {
        if (false === $this->isUploadedFile()) {
            throw new RuntimeException(
                'The file is not uploaded to the server by HTTP request',
                500
            );
        }

        $source = $this->getTmpName();

        Assert::throwLastErrorIfFalse(
            move_uploaded_file($source, $dest),
            'Unable to move uploaded file',
            500,
            'RuntimeException'
        );
    }

    public function isUploadedFile()
    {
        return is_uploaded_file($this->getTmpName());
    }
}

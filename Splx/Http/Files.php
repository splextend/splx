<?php

namespace Splx\Http;

use Splx\Core\Proto;

class Files extends Proto
{
    /**
     * UPLOAD_ERR_OK
    Value: 0; There is no error, the file uploaded with success.

    UPLOAD_ERR_INI_SIZE
    Value: 1; The uploaded file exceeds the upload_max_filesize directive in php.ini.

    UPLOAD_ERR_FORM_SIZE
    Value: 2; The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.

    UPLOAD_ERR_PARTIAL
    Value: 3; The uploaded file was only partially uploaded.

    UPLOAD_ERR_NO_FILE
    Value: 4; No file was uploaded.

    UPLOAD_ERR_NO_TMP_DIR
    Value: 6; Missing a temporary folder.

    UPLOAD_ERR_CANT_WRITE
    Value: 7; Failed to write file to disk.

    UPLOAD_ERR_EXTENSION
     *
     * $phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
    );
     */


    /**
     * @inheritDoc
     */
    public function valueOf()
    {
        // TODO: Implement valueOf() method.
    }
}
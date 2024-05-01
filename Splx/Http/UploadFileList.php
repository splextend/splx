<?php

namespace Splx\Http;

use Splx\Core\Proto;

class UploadFileList extends Proto
{
    public static function normalizeFiles($globalFiles)
    {
        $normalized = [];
        foreach ($globalFiles as $key => $file) {
            if (isset($file['name']) && is_array($file['name'])) {
                $new = [];
                foreach (['name', 'type', 'tmp_name', 'error', 'size'] as $k) {
                    array_walk_recursive($file[$k], function (&$data, $key, $k) {
                        $data = [$k => $data];
                    }, $k);
                    $new = array_replace_recursive($new, $file[$k]);
                }
                $normalized[$key] = $new;
            } else {
                $normalized[$key] = $file;
            }

            //$normalized[$key] = new UploadFile($normalized[$key]);
        }
        return $normalized;
    }

    /**
     * @inheritDoc
     */
    public function valueOf()
    {
        // TODO: Implement valueOf() method.
    }
}
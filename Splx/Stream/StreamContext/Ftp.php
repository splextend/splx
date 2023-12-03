<?php

namespace Splx\Stream\StreamContext;

/**
 * Class Curl
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method getOverwrite()
 * @method getResumePos()
 * @method getProxy()
 * @method self setOverwrite($value)
 * @method self setResumePos($value)
 * @method self setProxy($value)
 * @method delOverwrite()
 * @method delResumePos()
 * @method delProxy()
 */
class Ftp extends AbstractContext
{
    /**
     * @var string[]
     */
    protected $keys = [
        'overwrite',
        'resume_pos',
        'proxy'
    ];
}

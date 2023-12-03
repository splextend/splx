<?php

namespace Splx\Stream\StreamContext;

/**
 * Class MongoDB
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method getLogCmdInsert()
 * @method getLogCmdDelete()
 * @method getLogCmdUpdate()
 * @method getLogWriteBatch()
 * @method getLogReply()
 * @method getLogGetmore()
 * @method getLogKillcursor()
 * @method self setLogCmdInsert($value)
 * @method self setLogCmdDelete($value)
 * @method self setLogCmdUpdate($value)
 * @method self setLogWriteBatch($value)
 * @method self setLogReply($value)
 * @method self setLogGetmore($value)
 * @method self setLogKillcursor($value)
 * @method delLogCmdInsert()
 * @method delLogCmdDelete()
 * @method delLogCmdUpdate()
 * @method delLogWriteBatch()
 * @method delLogReply()
 * @method delLogGetmore()
 * @method delLogKillcursor()
*/
class MongoDB extends AbstractContext
{
    /**
     * @var string[]
     */
    protected $keys = [
        'log_cmd_insert',
        'log_cmd_delete',
        'log_cmd_update',
        'log_write_batch',
        'log_reply',
        'log_getmore',
        'log_killcursor'
    ];
}

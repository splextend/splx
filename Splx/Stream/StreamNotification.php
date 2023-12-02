<?php

namespace Splx\Stream;

use Splx\Core\Macros;

/**
 * Class StreamNotification
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splextend
 *
 * @method getNotificationCode()
 * @method getSeverity()
 * @method getMessage()
 * @method getMessageCode()
 * @method getBytesTransferred()
 * @method getBytesMax()
 * @method self setNotificationCode($value)
 * @method self setSeverity($value)
 * @method self setMessage($value)
 * @method self setMessageCode($value)
 * @method self setBytesTransferred($value)
 * @method self setBytesMax($value)
 * @method delNotificationCode()
 * @method delSeverity()
 * @method delMessage()
 * @method delMessageCode()
 * @method delBytesTransferred()
 * @method delBytesMax()
 */

class StreamNotification extends Macros
{
    protected $keys = [
        'notification_code',
        'severity',
        'message',
        'message_code',
        'bytes_transferred',
        'bytes_max'
    ];
}

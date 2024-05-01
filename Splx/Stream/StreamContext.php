<?php

namespace Splx\Stream;

use UnexpectedValueException;
use Splx\Core\Proto;

/**
 * Class StreamContext
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @property StreamContext\Curl $curl
 * @property StreamContext\Ftp $ftp
 * @property StreamContext\Http $http
 * @property StreamContext\Phar $phar
 * @property StreamContext\Socket $socket
 * @property StreamContext\Ssl $ssl
 * @property StreamContext\Zip $zip
 * @property StreamContext\Zlib $zlib
 * @property StreamContext\MongoDB $mongodb
 */
class StreamContext extends Proto
{
    /**
     * @var array
     */
    protected $wrappers = [];

    /**
     * @var array
     */
    protected $parameters = [];

    /*
     * @param $wrapper
     * @return bool
     */
    public function hasContext($wrapper)
    {
        return isset($this->wrappers[$wrapper]);
    }

    /**
     * @param $wrapper
     * @return string[]|true
     */
    public function isValid($wrapper)
    {
        if ($wrapper === 'zlib') {
            $wrapper = 'compress.zlib';
        }

        $availWrappers = stream_get_wrappers();

        if (in_array($wrapper, $availWrappers, true)) {
            return true;
        }

        return $availWrappers;
    }

    /**
     * @param $wrapper
     * @return StreamContext\AbstractContext
     */
    public function __get($wrapper)
    {
        if (!$this->hasContext($wrapper)) {
            if (is_array($availWrappers = $this->isValid($wrapper))) {
                throw new UnexpectedValueException(sprintf(
                    "Undefined stream context '%s', avail list %s",
                    $wrapper,
                    "['" . implode("', '", $availWrappers) . "']"
                ));
            }

            $class = __NAMESPACE__ . '\\StreamContext\\' . ucfirst($wrapper);
            $this->wrappers[$wrapper] = new $class($this);
        }

        return $this->wrappers[$wrapper];
    }

    public function setNotificationCallback(callable $callback)
    {
        $this->parameters['notification'] = function (
            $notificationCode,
            $severity,
            $message,
            $messageCode,
            $bytesTransferred,
            $bytesMax
        ) use ($callback) {
            $streamNotificationClone = new StreamNotification([
                'notification_code' => $notificationCode,
                'severity' => $severity,
                'message' => $message,
                'message_code' => $messageCode,
                'bytes_transferred' => $bytesTransferred,
                'bytes_max' => $bytesMax
            ]);

            call_user_func($callback, $streamNotificationClone);
        };

        return $this;
    }

    /**
     * @return resource
     */
    public function valueOf()
    {
        return stream_context_create(
            array_map(function ($wrapper) {
                return $wrapper->valueOf();
            }, $this->wrappers),
            $this->parameters
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $selfContext = get_class($this) . ' ';

        if ($this->wrappers) {
            return $selfContext . PHP_EOL . implode(PHP_EOL, array_map(function ($wrapper) {
                    return ' - ' . ((string) $wrapper);
            }, $this->wrappers));
        } else {
            return $selfContext . '(empty)';
        }
    }
}

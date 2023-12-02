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
 * @link     http://github.com/splextend/splextend
 *
 * @property Splx\Stream\StreamContext\Curl $curl
 * @property Splx\Stream\StreamContext\Ftp $ftp
 * @property Splx\Stream\StreamContext\Http $http
 * @property Splx\Stream\StreamContext\Phar $phar
 * @property Splx\Stream\StreamContext\Socket $socket
 * @property Splx\Stream\StreamContext\Ssl $ssl
 * @property Splx\Stream\StreamContext\Zip $zip
 */
class StreamContext extends Proto
{
    /**\
     * @var array
     */
    protected $wrappers = [];

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
        $availWrappers = stream_get_wrappers();

        if (in_array($wrapper, $availWrappers, true)) {
            return true;
        }

        return $availWrappers;
    }

    /**
     * @param $wrapper
     * @return Splx\Stream\StreamContext\AbstractContext
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
            $this->wrappers[$wrapper] = new $class;
        }

        return $this->wrappers[$wrapper];
    }

    /**
     * @return resource
     */
    public function valueOf()
    {
        return stream_context_create(
            array_map(function($wrapper){
                return $wrapper->valueOf();
            }, $this->wrappers)
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $selfContext = get_class($this) . ' ';

        if($this->wrappers) {
            return $selfContext . PHP_EOL . implode(PHP_EOL, array_map(function ($wrapper) {
                    return ' - ' . ((string) $wrapper);
                }, $this->wrappers));
        } else {
            return $selfContext . '(empty)';
        }
    }
}

<?php

namespace Splx\IO;

use Splx\Resource\AbstractResource;

/**
 * Class Socket
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method accept()
 * @method atmark()
 * @method bind($addr, $port)
 * @method clearError()
 * @method close()
 * @method cmsgSpace($type)
 * @method connect($addr, $port)
 * @method getOption($level, $optname)
 * @method lastError()
 * @method listen($backlog)
 * @method read($length, $type)
 * @method recv(&$buf, $len, $flags)
 * @method recvfrom(&$buf, $len, $flags, &$name, &$port)
 * @method recvmsg(&$msghdr, $flags)
 * @method send($buf, $len, $flags)
 * @method sendmsg($msghdr, $flags)
 * @method sendto($buf, $len, $flags, $addr, $port)
 * @method setBlock()
 * @method setNonblock()
 * @method setOption($level, $optname, $optval)
 * @method shutdown($how)
 * @method write($buf, $length)
 * @method wsaprotocolInfoExport($targetPid)
 * @method static clearError($socket)
 * @method static lastError($socket)
 * @method static select(&$readFds, &$writeFds, &$exceptFds, $tvSec, $tvUsec)
 * @method static strerror($errno)
 * @method static wsaprotocolInfoRelease($infoId)
 */
class Socket extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'socket_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'socket_accept',
        'socket_atmark',
        'socket_bind',
        'socket_clear_error',
        'socket_close',
        'socket_cmsg_space',
        'socket_connect',
        'socket_get_option',
        'socket_last_error',
        'socket_listen',
        'socket_read',
        'socket_recv',
        'socket_recvfrom',
        'socket_recvmsg',
        'socket_send',
        'socket_sendmsg',
        'socket_sendto',
        'socket_set_block',
        'socket_set_nonblock',
        'socket_set_option',
        'socket_shutdown',
        'socket_write',
        'socket_wsaprotocol_info_export',
        'socket_export_stream',
        'socket_getpeername',
        'socket_getsockname'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'socket_clear_error',
        'socket_create',
        'socket_create_listen',
        'socket_last_error',
        'socket_select',
        'socket_strerror',
        'socket_wsaprotocol_info_release',
        'socket_import_stream',
        'socket_create_pair'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'socket_accept',
        'socket_atmark',
        'socket_bind',
        'socket_connect',
        'socket_create',
        'socket_create_listen',
        'socket_get_option',
        'socket_listen',
        'socket_read',
        'socket_recv',
        'socket_recvfrom',
        'socket_recvmsg',
        'socket_select',
        'socket_send',
        'socket_sendmsg',
        'socket_sendto',
        'socket_set_block',
        'socket_set_nonblock',
        'socket_set_option',
        'socket_shutdown',
        'socket_write',
        'socket_wsaprotocol_info_export',
        'socket_export_stream',
        'socket_import_stream',
        'socket_getpeername',
        'socket_getsockname',
        'socket_create_pair'
    ];

    /**
     * @var string[]
     */
    protected static $selfInstanceMethod = [
        'socket_wsaprotocol_info_import',
        'socket_import_stream'
    ];

    /**
     * @param $resource
     */
    private function __construct($resource)
    {
        $this->setResource($resource, ['resource', 'Socket']);
    }

    /**
     * @param $domain
     * @param $type
     * @param $protocol
     * @return self
     */
    public static function create($domain, $type, $protocol)
    {
        $resource = self::__callStatic(
            'create',
            [$domain, $type, $protocol]
        );

        return new self($resource);
    }

    /**
     * @param $port
     * @param $backlog
     * @return self
     */
    public static function createListen($port, $backlog = 128)
    {
        $resource = self::__callStatic('createListen', [$port, $backlog]);

        return new self($resource);
    }

    /**
     * @param $domain
     * @param $type
     * @param $protocol
     * @return Socket[]
     */
    public static function createPair($domain, $type, $protocol)
    {
        $pair = [];

        self::__callStatic(
            'createPair',
            [$domain, $type, $protocol, &$pair]
        );

        $pair = array_map(function ($addrinfo) {
            return Socket::createFromResource(
                $addrinfo,
                ['resource', 'Socket']
            );
        }, $pair);

        return $pair;
    }

    /**
     * @param Stream $stream
     * @return Socket
     */
    public static function importStream(Stream $stream)
    {
        return self::__callStatic(
            'importStream',
            [$stream->valueOf()]
        );
    }

    /**
     * @return Stream
     */
    public function exportStream()
    {
        $stream = $this->__call('exportStream');

        return Stream::createFromResource($stream, ['resource']);
    }

    /**
     * @return array
     */
    public function getPeerName()
    {
        $address = $port = null;

        $this->__call('getpeername', [&$address, &$port]);

        return [$address, $port];
    }

    /**
     * @return array
     */
    public function getSockName()
    {
        $address = $port = null;

        $this->__call('getsockname', [&$address, &$port]);

        return [$address, $port];
    }

    public function __destruct()
    {
        $this->close();
    }
}

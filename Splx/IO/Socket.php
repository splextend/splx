<?php

namespace Spx\IO;

use Splx\Core\Assert;
use Splx\Resource\AbstractResource;

/**
 * Class CurlShare
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 */
class Socket extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'socket_';

    /**
     * @var array
     */
    protected static $functions = [
        'socket_accept',
        'socket_atmark',
        'socket_bind',
        'socket_clear_error',
        'socket_close',
        'socket_cmsg_space',
        'socket_connect'
    ];

    /**
     * @var array
     */
    protected static $staticFunctions = [
        'socket_clear_error'
    ];

    /**
     * @var array
     */
    protected static $watchFalseFunctions = [
        'socket_accept',
        'socket_atmark',
        'socket_bind',
        'socket_connect'
    ];

    private function __construct($resource)
    {
        $this->setResource($resource, ['resource', 'Socket']);
    }

    public static function create($domain, $type, $protocol)
    {
        $resource = socket_create(
            $domain,
            $type,
            $protocol
        );

        Assert::throwLastErrorIfFalse($resource);

        return new self($resource);
    }

    public static function createListen($port, $backlog = 128)
    {
        $resource = socket_create_listen($port, $backlog);

        Assert::throwLastErrorIfFalse($resource);

        return new self($resource);
    }

    public function __destruct()
    {
        $this->close();
    }
}

/*

socket_addrinfo_bind
socket_addrinfo_connect
socket_addrinfo_explain
socket_addrinfo_lookup


socket_create_pair

socket_export_stream
socket_get_option
socket_getopt
socket_getpeername
socket_getsockname
socket_import_stream
socket_last_error
socket_listen
socket_read
socket_recv
socket_recvfrom
socket_recvmsg
socket_select
socket_send
socket_sendmsg
socket_sendto
socket_set_block
socket_set_nonblock
socket_set_option
socket_setopt
socket_shutdown
socket_strerror
socket_write
socket_wsaprotocol_info_export
socket_wsaprotocol_info_import
socket_wsaprotocol_info_release
 */
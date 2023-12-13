<?php

namespace Splx\IO;

use Splx\Resource\AbstractResource;

/**
 *  Class SocketAddrInfo
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method explain()
 */
class SocketAddrInfo extends AbstractResource
{
    /**
     * @var string
     */
    protected static $prefix = 'socket_addrinfo_';

    /**
     * @var string[]
     */
    protected static $functions = [
        'socket_addrinfo_bind',
        'socket_addrinfo_connect',
        'socket_addrinfo_explain'
    ];

    /**
     * @var string[]
     */
    protected static $staticFunctions = [
        'socket_addrinfo_lookup'
    ];

    /**
     * @var string[]
     */
    protected static $watchFalseFunctions = [
        'socket_addrinfo_bind',
        'socket_addrinfo_connect'
    ];

    /**
     * @param $host
     * @param $service
     * @param array $hints
     * @return SocketAddrInfo[]
     */
    public static function lookup($host, $service = null, array $hints = [])
    {
        $list = self::__callStatic(
            'lookup',
            [
                $host,
                $service,
                $hints
            ]
        );

        $list = array_map(function ($addrinfo) {
            return SocketAddrInfo::createFromResource(
                $addrinfo,
                ['resource', 'AddressInfo']
            );
        }, $list);

        return $list;
    }

    /**
     * @return Socket
     */
    public function connect()
    {
        $resource = $this->__call('connect');

        return Socket::createFromResource($resource, ['resource', 'Socket']);
    }

    /**
     * @return Socket
     */
    public function bind()
    {
        $resource = $this->__call('bind');

        return Socket::createFromResource($resource, ['resource', 'Socket']);
    }
}

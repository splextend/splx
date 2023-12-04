<?php

namespace Splx\Stream\StreamContext;

/**
 * Class Socket
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method getBindto()
 * @method getBacklog()
 * @method getSoReuseport()
 * @method getSoBroadcast()
 * @method getTcpNodelay()
 * @method self setBindto($value)
 * @method self setBacklog($value)
 * @method self setSoReuseport($value)
 * @method self setSoBroadcast($value)
 * @method self setTcpNodelay($value)
 * @method delBindto()
 * @method delBacklog()
 * @method delSoReuseport()
 * @method delSoBroadcast()
 * @method delTcpNodelay()
 */
class Socket extends AbstractContext
{
    /**
     * @var string[]
     */
    protected $keys = [
        'bindto',
        'backlog',
        'ipv6_v6only',
        'so_reuseport',
        'so_broadcast',
        'tcp_nodelay'
    ];

    /**
     * @param $value
     * @return Socket
     */
    public function setIpV6Only($value)
    {
        return $this->set('ipv6_v6only', $value);
    }

    /**
     * @return mixed|null
     */
    public function getIpV6Only()
    {
        return $this->get('ipv6_v6only');
    }

    /**
     * @return Socket
     */
    public function delIpV6Only()
    {
        return $this->del('ipv6_v6only');
    }
}

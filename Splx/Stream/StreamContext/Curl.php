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
 * @method getMethod()
 * @method getHeader()
 * @method getUserAgent()
 * @method getContent()
 * @method getProxy()
 * @method getMaxRedirects()
 * @method getCurlVerifySslHost()
 * @method getCurlVerifySslPeer()
 * @method self setMethod($value)
 * @method self setHeader($value)
 * @method self setUserAgent($value)
 * @method self setContent($value)
 * @method self setProxy($value)
 * @method self setMaxRedirects($value)
 * @method self setCurlVerifySslHost($value)
 * @method self setCurlVerifySslPeer($value)
 * @method delMethod()
 * @method delHeader()
 * @method delUserAgent()
 * @method delContent()
 * @method delProxy()
 * @method delMaxRedirects()
 * @method delCurlVerifySslHost()
 * @method delCurlVerifySslPeer()
 */
class Curl extends AbstractContext
{
    /**
     * @var string[]
     */
    protected $keys = [
        'method',
        'header',
        'user_agent',
        'content',
        'proxy',
        'max_redirects',
        'curl_verify_ssl_host',
        'curl_verify_ssl_peer'
    ];
}

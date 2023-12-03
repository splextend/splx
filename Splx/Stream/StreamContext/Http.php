<?php

namespace Splx\Stream\StreamContext;

/**
 * Class Http
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
 * @method getRequestFulluri()
 * @method getFollowLocation()
 * @method getMaxRedirects()
 * @method getProtocolVersion()
 * @method getTimeout()
 * @method getIgnoreErrors()
 * @method self setMethod($value)
 * @method self setHeader($value)
 * @method self setUserAgent($value)
 * @method self setContent($value)
 * @method self setProxy($value)
 * @method self setRequestFulluri($value)
 * @method self setFollowLocation($value)
 * @method self setMaxRedirects($value)
 * @method self setProtocolVersion($value)
 * @method self setTimeout($value)
 * @method self setIgnoreErrors($value)
 * @method delMethod()
 * @method delHeader()
 * @method delUserAgent()
 * @method delContent()
 * @method delProxy()
 * @method delRequestFulluri()
 * @method delFollowLocation()
 * @method delMaxRedirects()
 * @method delProtocolVersion()
 * @method delTimeout()
 * @method delIgnoreErrors()
 */
class Http extends AbstractContext
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
        'request_fulluri',
        'follow_location',
        'max_redirects',
        'protocol_version',
        'timeout',
        'ignore_errors'
    ];
}

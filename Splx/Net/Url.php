<?php

namespace Splx\Net;

use Splx\Core\Assert;
use Splx\Core\Macros;

/**
 *  Class Url
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 *
 * @method getScheme()
 * @method getUser()
 * @method getPass()
 * @method getHost()
 * @method getPort()
 * @method getPath()
 * @method getQuery()
 * @method getFragment()
 * @method self setScheme($value)
 * @method self setUser($value)
 * @method self setPass($value)
 * @method self setHost($value)
 * @method self setPort($value)
 * @method self setPath($value)
 * @method self setQuery($value)
 * @method self setFragment($value)
 * @method delScheme()
 * @method delUser()
 * @method delPass()
 * @method delHost()
 * @method delPort()
 * @method delPath()
 * @method delQuery()
 * @method delFragment()
 */
class Url extends Macros
{
    /**
     * @var string[]
     */
    protected $keys = [
        'scheme',
        'user',
        'pass',
        'host',
        'port',
        'path',
        'query',
        'fragment'
    ];

    /**
     * @param $url
     */
    public function __construct($url = null)
    {
        if (is_null($url)) {
            return;
        }

        $url = Proto::valueOf($url);

        Assert::validateInstance($url, 'string');

        $parsed = parse_url($url);
        Assert::throwIfFalse(
            $parsed,
            "Failed to parse URL"
        );

        foreach ($parsed as $key => $value) {
            if ($key === 'query') {
                parse_str($value, $value);
            }

            $this->set($key, $value);
        }
    }

    /**
     * @return string
     */
    public function valueOf()
    {
        return $this->__toString();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $url = '';
        foreach ($this->keys as $key) {
            $value = $this->get($key);

            if (is_string($value)) {
                $value = trim($value);
            }

            if (empty($value)) {
                if ($value !== 0 and $value !== '0') {
                    continue;
                }
            }

            if ($key === 'port' or $key === 'pass') {
                $url .= ':';
            } elseif ($key === 'path') {
                $value = ltrim($value, '/');
            } elseif ($key === 'query') {
                $url .= '?';

                if (is_array($value) or is_object($value)) {
                    $value = http_build_query($value);
                }
            } elseif ($key === 'fragment') {
                $url .= '#';
            }

            $url .= $value;

            if ($key === 'scheme') {
                $url .= '://';
            } elseif ($key === 'user') {
                if (!$this->getPass()) {
                    $url .= '@';
                }
            } elseif ($key === 'pass') {
                $url .= '@';
            } elseif ($key === 'port') {
                $url .= '/';
            } elseif ($key === 'host') {
                if (!$this->getPort()) {
                    $url .= '/';
                }
            }
        }

        return $url;
    }
}

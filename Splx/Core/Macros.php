<?php

namespace Splx\Core;

use ArrayAccess;
use Serializable;
use Countable;
use IteratorAggregate;
use BadMethodCallException;
use OutOfBoundsException;

/**
 * Class Transport
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class Macros extends Storage implements ArrayAccess, IteratorAggregate, Serializable, Countable
{
    use \Splx\Core\Traits\ArrayAccess;
    use \Splx\Core\Traits\ArrayIterator;
    use \Splx\Core\Traits\Countable;
    use \Splx\Core\Traits\Serializable;
    use \Splx\Core\Traits\Watchable;

    /**
     * @var array
     */
    protected $keys = array();

    /**
     * @param array $storage
     */
    public function __construct(array $storage = [])
    {
        foreach ($storage as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @param $key
     * @param $default
     * @return array|mixed|null
     */
    public function get($key, $default = null)
    {
        $value = parent::get($key, $default);

        if ($this->watchers) {
            $this->resolveWatch(__FUNCTION__, $key, $value);
        }

        return $value;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        if ($this->watchers) {
            $oldValue = $this->get($key);
            parent::set($key, $value);
            $this->resolveWatch(__FUNCTION__, $key, $value, $oldValue);
        } else {
            parent::set($key, $value);
        }

        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function del($key)
    {
        if ($this->watchers) {
            $oldValue = $this->get($key);
            parent::del($key);
            $this->resolveWatch(__FUNCTION__, $key, null, $oldValue);
        } else {
            parent::del($key);
        }

        return $this;
    }

    /**
     * @param $method
     * @param array $arguments
     * @return $this|mixed
     */
    public function __call($method, array $arguments)
    {
        $prefix = substr($method, 0, 3);
        $key    = substr($method, 3);
        $key    = lcfirst($key);
        $key    = Misc::toSnakeCase($key);

        if (!$this->has($key)) {
            throw new OutOfBoundsException(
                sprintf(
                    "Property '%s' is not defined in '%s'",
                    $key,
                    get_class($this)
                )
            );
        }

        if ('set' === $prefix) {
            $value = reset($arguments);

            return $this->set($key, $value);
        } elseif ('get' === $prefix) {
            return $this->get($key);
        } elseif ('del' === $prefix) {
            return $this->del($key);
        }

        throw new BadMethodCallException(
            sprintf(
                "Method '%s' is not defined in '%s'",
                $method,
                get_class($this)
            )
        );
    }

    /**
     * @return string
     */
    public function exportCallPrototype()
    {
        $doc = '/**' . PHP_EOL;
        foreach (['get', 'set', 'del'] as $prefix) {
            foreach ($this->keys as $key) {
                $doc .= sprintf(
                    ' * @method %s%s(%s)',
                    'set' === $prefix ? 'self ' : '',
                    Misc::toCamelCase($prefix . '_' . $key),
                    'set' === $prefix ? '$value' : ''
                ) . PHP_EOL;
            }
        }

        $doc .= ' */';

        return $doc;
    }

    /**
     * @return string[]
     */
    public function valueOf()
    {
        return $this->storage;
    }
}

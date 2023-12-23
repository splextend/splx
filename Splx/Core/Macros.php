<?php

namespace Splx\Core;

use ArrayAccess;
use ArrayIterator;
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
class Macros extends Proto implements ArrayAccess, IteratorAggregate, Serializable, Countable
{
    /**
     * @var array
     */
    protected $storage = [];

    protected $watchers = [];

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
     * @param $action
     * @param $key
     * @param $value
     * @param $oldValue
     * @return void
     */
    public function resolveWatch($action, $key, $value, $oldValue = null)
    {
        if ($this->watchers) {
            foreach (['*', $key] as $eventKey => $callbackStack) {
                if (isset($this->watchers[$eventKey])) {
                    foreach ($this->watchers[$eventKey] as $callback) {
                        call_user_func(
                            $callback,
                            $this,
                            $action,
                            $key,
                            $value,
                            $oldValue
                        );
                    }
                }
            }
        }
    }

    /**
     * @param callable $callback
     * @param $key
     * @return $this
     */
    public function watch(callable $callback, $key = null)
    {
        if (null === $key) {
            $key = '*';
        }

        if (!isset($this->watchers[$key])) {
            $this->watchers[$key] = [];
        }

        $this->watchers[$key][] = $callback;

        return $this;
    }

    /**
     * @param $watcher
     * @param $key
     * @return bool
     */
    public function unwatch($watcher, $key = null)
    {
        if (null === $key) {
            $key = '*';
        }

        if (!isset($this->watchers[$key])) {
            return false;
        }

        foreach ($this->watchers[$key] as $index => $callback) {
            if ($callback === $watcher) {
                unset($this->watchers[$index]);

                return true;
            }
        }

        return false;
    }

    /**
     * @param $key
     * @return mixed|void
     */
    public function get($key)
    {
        $value = null;
        if (isset($this->storage[$key])) {
            $value = $this->storage[$key];
        }

        $this->resolveWatch(__FUNCTION__, $key, $value);

        return $value;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $oldValue = (
            isset($this->storage[$key])
                ? $this->storage[$key]
                : null
        );

        $this->storage[$key] = $value;
        $this->resolveWatch(__FUNCTION__, $key, $value, $oldValue);

        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return in_array($key, $this->keys, true);
    }

    /**
     * @param $key
     * @return $this
     */
    public function del($key)
    {
        $oldValue = (
            isset($this->storage[$key])
            ? $this->storage[$key]
            : null
        );

        unset($this->storage[$key]);
        $this->resolveWatch(__FUNCTION__, $key, null, $oldValue);

        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * @param $key
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->del($key);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->storage);
    }

    public function serialize()
    {
        return serialize($this->storage);
    }

    public function unserialize($data)
    {
        $unserialize = unserialize($data);
        Assert::throwIfFalse(
            $unserialize,
            'Cannot unserialize given value'
        );

        $this->storage = $unserialize;
    }

    public function count()
    {
        return count($this->storage);
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

<?php

namespace Splx\Core;

use BadMethodCallException;
use OutOfBoundsException;

/**
 * Class Transport
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splextend
 */
class Macros extends Proto
{
    /**
     * @var array
     */
    protected $storage = array();

    /**
     * @var array
     */
    protected $keys = array();

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

        if (!in_array($key, $this->keys)) {
            throw new OutOfBoundsException(
                sprintf(
                    "Property '%s' is not defined in '%s'",
                    $key,
                    get_class($this)
                )
            );
        }

        if ('set' === $prefix) {
            $this->storage[$key] = reset($arguments);

            return $this;
        } elseif ('get' === $prefix) {
            return $this->storage[$key];
        } elseif ('del' === $prefix) {
            unset($this->storage[$key]);

            return $this;
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

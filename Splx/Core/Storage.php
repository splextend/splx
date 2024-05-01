<?php

namespace Splx\Core;

abstract class Storage extends Proto
{
    /**
     * @var array
     */
    protected $storage = [];

    /**
     * @param $key
     * @param $default
     * @return array|mixed|null
     */
    public function get($key, $default = null)
    {
        if (is_null($key)) {
            return $default;
        }

        $storage = &$this->storage;

        if (array_key_exists($key, $storage)) {
            return $storage[$key];
        }

        foreach (explode('.', $key) as $segment) {
            if (is_array($storage) and array_key_exists($segment, $storage)) {
                $storage = $storage[$segment];
            } else {
                return $default;
            }
        }

        return $storage;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        if (is_null($key)) {
            return $this;
        }

        $keys = explode('.', $key);
        $storage = &$this->storage;

        foreach ($keys as $i => $key) {
            if (count($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            if (!isset($storage[$key]) or !is_array($storage[$key])) {
                $storage[$key] = [];
            }

            $storage = &$storage[$key];
        }

        $storage[array_shift($keys)] = $value;

        return $this;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        if (is_null($key)) {
            return false;
        }

        if (array_key_exists($key, $this->storage)) {
            return true;
        }

        $storage = $this->storage;

        foreach (explode('.', $key) as $segment) {
            if (is_array($storage) and array_key_exists($segment, $storage)) {
                $storage = $storage[$segment];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $key
     * @return $this
     */
    public function del($key)
    {
        if (is_null($key)) {
            return $this;
        }

        if (array_key_exists($key, $this->storage)) {
            unset($this->storage[$key]);

            return $this;
        }

        $parts = explode('.', $key);
        $storage = &$this->storage;

        while (count($parts) > 1) {
            $part = array_shift($parts);

            if (isset($storage[$part]) and is_array($storage[$part])) {
                $storage = &$storage[$part];
            } else {
                break;
            }
        }

        unset($storage[array_shift($parts)]);

        return $this;
    }
}

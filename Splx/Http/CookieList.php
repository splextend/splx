<?php

namespace Splx\Http;

use Countable;
use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Splx\Core\Proto;

class CookieList extends Proto implements ArrayAccess, IteratorAggregate, Countable
{
    /**
     * @var Cookie[]
     */
    private $cookies = [];

    /**
     * @param Cookie $cookie
     * @return $this
     */
    public function push(Cookie $cookie)
    {
        $name = $cookie->getName();
        $this->cookies[$name] = $cookie;

        return $this;
    }

    /**
     * @param $name
     * @param $value
     * @return Cookie
     */
    public function create($name, $value = null)
    {
        if (isset($this->cookies[$name])) {
            $cookie = $this->cookies[$name];
        } else {
            $cookie = new Cookie();
            $this->push($cookie);
        }

        $cookie->setName($name);
        $cookie->setValue($value);

        return $cookie;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->cookies);
    }

    /**
     * @param $name
     * @return bool
     */
    public function offsetExists($name)
    {
        return isset($this->cookies[$name]);
    }

    /**
     * @param $name
     * @return Cookie|void
     */
    public function offsetGet($name)
    {
        if (isset($this->cookies[$name])) {
            return $this->cookies[$name];
        }
    }

    /**
     * @param $name
     * @param $value
     * @return void
     */
    public function offsetSet($name, $value)
    {
        $this->create(
            $name,
            $value
        );
    }

    /**
     * @param $name
     * @return void
     */
    public function offsetUnset($name)
    {
        unset($this->cookies[$name]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->cookies);
    }

    /**
     * @return Cookie[]
     */
    public function valueOf()
    {
        return $this->cookies;
    }
}

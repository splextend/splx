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

    public function push(Cookie $cookie)
    {
        $name = $cookie->getName();
        $this->cookies[$name] = $cookie;

        return $this;
    }

    public function create($name)
    {
        $cookie = new Cookie();
        $cookie->setName();
        $this->push($cookie);

        return $cookie;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->cookies);
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

    public function count()
    {
        return count($this->cookies);
    }

    public function valueOf()
    {
        return $this->cookies;
    }
}
<?php

namespace Splx\Core;

class ReadonlyMacros extends Macros
{
    private $writeable = false;

    public function __construct(array $storage = [])
    {
        $this->writeable = true;
        parent::__construct($storage);
        $this->writeable = false;
    }

    private function decline()
    {
        throw new LogicException(
            "The class is available in read-only mode"
        );
    }

    public function set($key, $value)
    {
        if (false === $this->writeable) {
            $this->decline();
        }
    }

    public function del($key)
    {
        $this->decline();
    }
}

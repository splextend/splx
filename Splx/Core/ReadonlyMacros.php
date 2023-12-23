<?php

namespace Splx\Core;

use LogicException;

/**
 * Class ReadonlyMacros
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class ReadonlyMacros extends Macros
{
    /**
     * @var
     */
    private $writeable;

    /**
     * @param array $storage
     */
    public function __construct(array $storage = [])
    {
        $this->writeable = true;
        parent::__construct($storage);
        $this->writeable = false;
    }

    /**
     * @return mixed
     */
    private function decline()
    {
        throw new LogicException(
            "The class is available in read-only mode"
        );
    }

    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function set($key, $value)
    {
        if (false === $this->writeable) {
            $this->decline();
        }
    }

    /**
     * @param $key
     * @return void
     */
    public function del($key)
    {
        $this->decline();
    }
}

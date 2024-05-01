<?php

namespace Splx\Stream\StreamContext;

use Splx\Core\Macros;
use Splx\Stream\StreamContext;

/**
 * Class AbstractContext
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
abstract class AbstractContext extends Macros
{
    /**
     * @var StreamContext
     */
    private $streamContext;

    /**
     * @param StreamContext $streamContext
     */
    public function __construct(StreamContext $streamContext)
    {
        $this->streamContext = $streamContext;
    }

    /**
     * @return StreamContext
     */
    public function next()
    {
        return $this->streamContext;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $inline = [get_class($this)];

        if ($this->storage) {
            foreach ($this->storage as $key => $value) {
                $inline[] = '   - ' . $key . ': ' . ((string) $value);
            }
        } else {
            $inline[] = '   (empty)';
        }

        return implode(PHP_EOL, $inline);
    }
}

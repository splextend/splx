<?php

namespace Splx\Stream\StreamContext;

use Splx\Core\Macros;

/**
 * Class AbstractContext
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splextend
 */
abstract class AbstractContext extends Macros
{
    /**
     * @return string
     */
    public function __toString()
    {
        $inline = [get_class($this)];

        if ($this->storage) {
            foreach ($this->storage as $key => $value) {
                $inline[] = ' - ' . $key . ': ' . ((string) $value);
            }
        } else {
            $inline[] = ' (empty)';
        }

        return implode($inline);
    }
}

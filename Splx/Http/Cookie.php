<?php

namespace Splx\Http;

use Splx\Core\Macros;

class Cookie extends Macros
{
    /**
     * @var string[]
     */
    protected $keys = [
        'name',
        'value',
        'expires',
        'max_age',
        'path',
        'domain',
        'secure',
        'httponly',
        'samesite'
    ];

    public function __toString()
    {
        $cookie = [
            $this->getName() . '=' . $this->getValue()
        ];

        foreach ($this as $key => $value) {
            if ($key === 'name' or $key === 'value' or !$value) {
                continue;
            }

            if ($key === 'expires') {
                $cookie[] = 'Expires=' . $value;
            }

            if ($key === 'max_age') {
                $cookie[] = 'Max-Age=' . $value;
            }

            if ($key === 'domain') {
                $cookie[] = 'Domain=' . $value;
            }

            if ($key === 'secure') {
                $cookie[] = 'Secure';
            }

            if ($key === 'httpopnly') {
                $cookie[] = 'HttpOnly';
            }

            if ($key === 'samesite') {
                $cookie[] = 'SameSite=' . $value;
            }
        }

        return implode(';', $cookie);
    }
}

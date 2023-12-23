<?php

namespace Splx\Http;

use Splx\Core\Macros;

class Request extends Macros
{
    protected $keys = [
        'method',
        'path',
        'protocol_version',
        'header',
        'cookie',
        'body'
    ];

    public function __construct()
    {
        $storage = [
            'method' => 'GET',
            'path' => '/',
            'protocol_version' => 1.1,
            'header' => new Header(),
            'cookie' => new CookieList()
        ];

        parent::__construct($storage);
    }
}
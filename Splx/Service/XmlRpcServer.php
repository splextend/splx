<?php

namespace Splx\Service;

use Splx\Resource\AbstractResource;

class XmlRpcServer extends AbstractResource
{
    protected static $prefix = 'xmlrpc_server_';

    /**
     * @var array
     */
    protected static $functions = [];

    /**
     * @var array
     */
    protected static $staticFunctions = [];

    /**
     * @var array
     */
    protected static $watchFalseFunctions = [];
}

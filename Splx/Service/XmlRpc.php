<?php

namespace Splx\Service;

use Splx\Resource\AbstractResource;

class XmlRpc extends AbstractResource
{
    protected static $prefix = 'xmlrpc_';

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

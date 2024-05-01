<?php

namespace Splx\Stream;

use Splx\Core\Assert;
use Splx\Resource\AbstractResource;

class Stream extends AbstractResource
{
    protected static $prefix = 'stream_';

    protected static $functions = array(
        'stream_copy_to_stream',
        'stream_filter_append',
        'stream_filter_prepend',
        'stream_filter_remove',
        'stream_get_contents',
        'stream_get_line',
        'stream_get_meta_data',
        'stream_is_local',
        'stream_isatty',
        'stream_set_blocking',
        'stream_set_chunk_size',
        'stream_set_read_buffer',
        'stream_set_timeout',
        'stream_set_write_buffer',
        'stream_socket_accept',
        'stream_socket_enable_crypto',
        'stream_socket_get_name',
        'stream_socket_recvfrom',
        'stream_socket_sendto',
        'stream_socket_shutdown',
        'stream_supports_lock'
    );

    protected static $staticFunctions = array(
        'stream_filter_register',
        'stream_get_filters',
        'stream_get_transports',
        'stream_get_wrappers',
        'stream_is_local',
        'stream_notification_callback',
        'stream_resolve_include_path',
        'stream_select',
        'stream_socket_pair',
        'stream_wrapper_register',
        'stream_wrapper_restore',
        'stream_wrapper_unregister',
        'stream_socket_client',
        'stream_socket_server'
    );

    protected static $watchFalseFunctions = [
        'stream_copy_to_stream'
    ];

    protected static $selfInstanceMethod = [

    ];

    public static function socketClient($address, $timeout = 30, StreamContext $context = null, $flags = 4)
    {
        $errorCode = $errorMessage = null;

        $resource =  self::__callStatic(
            'socketClient',
            [$address, &$errorCode, &$errorMessage, $timeout, $flags, $context]
        );

        Assert::throwIfFalse(
            $resource,
            $errorMessage,
            $errorCode
        );

        return Stream::createFromResource($resource);
    }

    public static function socketServer($address, StreamContext $context = null, $flags = 12)
    {
        $errorCode = $errorMessage = null;

        $resource = self::__callStatic(
            'socketServer',
            [$address, &$errorCode, &$errorMessage, $flags, $context]
        );

        Assert::throwIfFalse(
            $resource,
            $errorMessage,
            $errorCode
        );

        return Stream::createFromResource($resource);
    }
}

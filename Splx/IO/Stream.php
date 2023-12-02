<?php
namespace Splx\IO;

use UnexpectedValueException;
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
        'stream_wrapper_unregister'
    );

	protected function __construct($function, $target, $context, $flags)
	{
        $errno = $errstr = null;

		$arguments = array(
            $target,
            &$errno,
            &$errstr
        );

		if ($function === 'stream_socket_client') {
			$arguments[] = ini_get("default_socket_timeout");
		}

		$arguments[] = $flags;

		if ($context) {
			$arguments[] = $context->valueOf();
		}

        $this->resource = call_user_func_array($function, $arguments);
        if(false === is_resource($this->resource)){
            throw new UnexpectedValueException(
                $errstr,
                $errno
            );
        }
	}

	public static function socketClient($target, StreamContext $context = null, $flags = STREAM_CLIENT_CONNECT)
	{
		return new static(
			'stream_socket_client',
			$target,
			$context,
			$flags
		);
	}

	public static function socketServer($target, StreamContext $context = null, $flags = STREAM_SERVER_BIND | STREAM_SERVER_LISTEN)
	{
		return new static(
			'stream_socket_server',
			$target,
			$context,
			$flags
		);
	}
}
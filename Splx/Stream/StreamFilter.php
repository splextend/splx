<?php

namespace Splx\Stream;

use php_user_filter;
use Splx\IO\Stream;

/**
 * Class StreamFilter
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
abstract class StreamFilter extends php_user_filter
{
    /**
     * @return void
     */
    public function onCreate()
    {
        $this->handleOpen();
    }

    /**
     * @return void
     */
    public function onClose()
    {
        $this->handleClose();
    }

    /**
     * @param $in
     * @param $out
     * @param $consumed
     * @param $closing
     * @return int
     */
    public function filter($in, $out, &$consumed, $closing)
    {
        try {
            $response = $this->handle(
                Stream::createFromResource($in),
                Stream::createFromResource($out),
                $consumed,
                $closing
            );

            if (false === $response) {
                return PSFS_FEED_ME;
            }

            return PSFS_PASS_ON;
        } catch (Exception $e) {
            return PSFS_ERR_FATAL;
        } catch (Throwable $e) {
            return PSFS_ERR_FATAL;
        }
    }

    /**
     * @param Stream $inputStream
     * @param Stream $outputStream
     * @param $consumed
     * @param $isEnd
     * @return mixed
     */
    abstract public function handle(Stream $inputStream, Stream $outputStream, &$consumed, $isEnd);

    /**
     * @return void
     */
    abstract public function handleOpen();

    /**
     * @return void
     */
    abstract public function handleClose();
}

<?php

namespace Spxl\IO;

use Curl;
use Splx\Core\Proto;
use Splx\IO\CurlMulti;

/**
 * Class CurlShare
 *
 * @category PHP Standard Library Extension
 * @package  Splx
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://github.com/splextend/splx
 */
class CurlPool extends Proto
{
    /**
     * @var CurlMulti
     */
    private $curlMulti;

    /**
     * @var Curl[]
     */
    private $curlHandles = [];

    public function __construct()
    {
        $this->curlMulti = new CurlMulti();
    }

    /**
     * @param Curl $curl
     * @return $this
     */
    public function push(Curl $curl)
    {
        $this->curlHandles[] = $curl;

        return $this;
    }

    /**
     * @param $selectTimeout
     * @return void
     */
    public function exec($selectTimeout = 1.0)
    {
        foreach ($this->curlHandles as $curl) {
            $this->curlMulti->addHandle($curl);
        }

        $stillRunning = false;
        do {
            $status = $this->curlMulti->exec($stillRunning);
            if ($stillRunning) {
                $this->curlMulti->select($selectTimeout);
            }
        } while ($stillRunning and $status == CURLM_OK);
    }

    /**
     * @return CurlMulti
     */
    public function valueOf()
    {
        return $this->curlMulti;
    }

    public function __destruct()
    {
        foreach ($this->curlHandles as $curl) {
            $this->curlMulti->removeHandle($curl);
            $curl->close();
        }

        $this->curlMulti->close();
    }
}

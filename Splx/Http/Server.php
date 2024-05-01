<?php

namespace Splx\Http;

use Splx\Core\Macros;

class Server extends Macros
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    private $uploadedFiles;

    protected $keys = [

    ];

    private function __construct()
    {
        parent::__construct($storage);
    }

    public static function resolveInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function getRequest()
    {
        if (is_null($this->request)) {
            $this->request = new Request();

            $cookie = $this->request->getCookie();
            foreach ($_COOKIE as $name => $value) {
                $cookie->create($name)->setValue($value);
            }
        }

        return $this->request;
    }

    public function getResponse()
    {
        if (is_null($this->response)) {
            $this->response = new Response();
        }

        return $this->response;
    }

    public function getUploadedFiles()
    {
        if (is_null($this->uploadedFiles)) {
            $this->uploadedFiles = $_FILES;
        }

        return $this->uploadedFiles;
    }
}

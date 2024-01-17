<?php

namespace App\Core\Router;

class Response
{
    private $headers = [];
    private $body;
    private $status;

    public function __construct()
    {
        $this->setStatus(200);
    }

    public function render()
    {
        foreach ($this->headers as $key => $value) {
            header($key.': '.$value, true, $this->status);
        }

        http_response_code($this->status);

        echo $this->body;
    }

    public function redirect(string $uri='/')
    {
        header('Location: ' . $uri, true, 302);
        exit();
    }

    public function setHeader(string $key, string $value)
    {
        $this->headers[$key] = $value;

        return $this;
    }

    public function setStatus(int $code)
    {
        $this->status = $code;

        return $this;
    }

    public function setBody(string $body)
    {
        $this->body = $body;

        return $this;
    }
}
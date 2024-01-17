<?php

namespace App\Core\Router;

use App\Core\Cookie\Cookie;
use App\Core\Session\Session;

class Request
{
    private $method;
    private $uri;
    private $params;
    private $session;
    private $cookie;

    public function __construct(string $method, string $uri, array $params, Session $session, Cookie $cookie)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->params = $params;
        $this->session = $session;
        $this->cookie = $cookie;
    }

    public function get(?string $key=null)
    {
        return $key ? (isset($this->params[$key]) ? $this->params[$key] : null) : $this->params;
    }

    public function add(string $key, $value)
    {
        $this->params[$key] = $value;
    }

    public function session() : Session
    {
        return $this->session;
    }

    public function cookie() : Cookie
    {
        return $this->cookie;
    }
}

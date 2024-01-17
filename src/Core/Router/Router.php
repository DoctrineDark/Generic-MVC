<?php

namespace App\Core\Router;

use App\Core\Config\Config;
use App\Core\Cookie\Cookie;
use App\Core\PDO\Connection;
use App\Core\Session\Session;
use App\Models\Model;

class Router
{
    private $routes;
    private $database;

    private $session;
    private $cookie;

    private $get;
    private $post;

    public function __construct(Config $config)
    {
        $this->routes = $config->get('routes');
        $this->database = $config->get('database');

        $this->session = new Session();
        $this->cookie = new Cookie();

        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function run(string $uri, string $method) : void
    {
        foreach($this->routes as $route) {
            $pattern = "@^" . preg_replace('/\\\:([a-zA-Z0-9\_\-]+)/', '(?P<$1>[a-zA-Z0-9\-\_]+)', preg_quote($route['uri'])) . "$@D";
            $params = [];

            if(strtolower($method) === strtolower($route['method']) && preg_match($pattern, $uri, $params)) {
                array_shift($params);

                // Connection
                $connection = new Connection($this->database['dsn']);
                Model::setConnection($connection);

                $request = new Request($method, $uri, array_merge($params, $this->get, $this->post), $this->session, $this->cookie);
                $controller = $route['controller'];
                $action = $route['action'];
                $route = new Route($controller, $action);
                $route->handle($request)->render();

                return;
            }
        }

        $this->notFound();
    }

    private function notFound()
    {
        $response = new Response();
        $response->setStatus(404)->render();
    }
}
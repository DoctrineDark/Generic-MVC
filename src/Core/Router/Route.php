<?php

namespace App\Core\Router;

class Route
{
    public $controller;
    public $action;

    public function __construct(string $controller, string $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }

    public function handle(Request $request) : Response
    {
        $controller = new $this->controller($request);
        $response = $controller->{$this->action}();

        return $response;
    }
}
<?php

namespace App\Controllers;

use App\Core\Router\Request;
use App\Core\Router\Response;

class Controller
{
    protected $request;
    protected $response;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->response = new Response();
    }
}
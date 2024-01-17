<?php

namespace App\Core\Session;

use App\Core\Router\Response;
use App\Models\User;

class Session
{
    public function __construct()
    {
        return $this->start();
    }

    public function start() : self
    {
        session_start();

        return $this;
    }

    public function set(string $name, $value) : self
    {
        $_SESSION[$name] = $value;

        return $this;
    }

    public function all()
    {
        return $_SESSION;
    }

    public function get(string $name)
    {
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }

        return null;
    }

    public function delete($name) : self
    {
        unset($_SESSION[$name]);

        return $this;
    }

    public function destroy() : self
    {
        $_SESSION = array();
        session_destroy();

        return $this;
    }

    public function user(string $authenticatable='user', string $class=User::class) : User
    {
        $user = $this->get($authenticatable);

        if($user && $user instanceof $class) {
            return $user;
        }

        $response = new Response();
        $response->redirect('/login');
    }
}
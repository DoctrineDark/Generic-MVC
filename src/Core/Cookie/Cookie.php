<?php

namespace App\Core\Cookie;

class Cookie
{
    private $hour = 3600;

    public function set(string $name, string $value = "", int $hours = 1, string $path = "/") : self
    {
        setcookie(
            $name,
            $value,
            (time() + ($hours * $this->hour)),
            $path,
            $domain = "",
            $secure = false,
            $httponly = true
        );

        return $this;
    }

    function all()
    {
        return $_COOKIE;
    }

    function get(string $name)
    {
        if(isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }

        return null;
    }

    function delete($name) : self
    {
        unset($_COOKIE[$name]);
        setcookie($name, '', -1, '/');

        return $this;
    }
}
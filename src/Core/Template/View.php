<?php

namespace App\Core\Template;

class View
{
    private static $dir = __DIR__.'/../../../resources/views/';

    public static function setDir(string $dir)
    {
        static::$dir = $dir;
    }

    public static function render(string $template, array $data) : string
    {
        ob_start();

        extract($data);

        $path = static::getPath($template);

        require_once $path;

        return ob_get_clean();
    }

    private static function getPath(string $template)
    {
        $path = static::$dir.str_replace('.', '/', $template).'.php';

        return $path;
    }
}
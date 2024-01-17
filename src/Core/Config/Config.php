<?php

namespace App\Core\Config;

use App\Core\Config\Contracts\ConfigInterface;
use App\Core\Config\Exceptions\InvalidFormatException;
use App\Core\Config\Exceptions\NotFoundConfigValue;

class Config implements ConfigInterface
{
    private $dir;
    private $config;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
        $this->config = $this->load();
    }

    /**
     * @return array
     * @throws InvalidFormatException
     */
    private function load() : array
    {
        $config = [];
        $files = glob($this->dir . '*.php');

        foreach ($files as $file) {
            $content = require($file);

            if(!is_array($content)) {
                throw new InvalidFormatException;
            }

            $config[pathinfo($file, PATHINFO_FILENAME)] = $content;
        }

        return $config;
    }

    /**
     * @param string|null $key
     * @return array|mixed
     * @throws NotFoundConfigValue
     */
    public function get(?string $key = null)
    {
        $config = $this->config;
        $keys = explode('.', $key ?? '');

        foreach ($keys as $key) {
            if (isset($config[$key])) {
                $config = $config[$key];
                continue;
            }
            else {
                throw new NotFoundConfigValue;
            }
        }

        return $config;
    }
}
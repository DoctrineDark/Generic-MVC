<?php

namespace App\Core\Config\Contracts;

interface ConfigInterface
{
    /**
     * @param string|null $key
     * @return mixed
     */
    public function get(?string $key);
}
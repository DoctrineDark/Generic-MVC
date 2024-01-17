<?php

namespace App\Core\PDO;

class Connection
{
    private $dsn;
    private $connection;

    public function __construct(string $dsn)
    {
        $this->dsn = $dsn;
    }

    public function connect() : \PDO
    {
        $this->connection = new \PDO($this->dsn);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->connection;
    }
}
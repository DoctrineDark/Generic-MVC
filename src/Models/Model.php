<?php

namespace App\Models;

use App\Core\PDO\Connection;
use App\Models\Traits\Queryable;

abstract class Model implements \JsonSerializable
{
    use Queryable;

    protected $attributes;
    protected static $table;
    protected static $primaryKey;
    private static \PDO $connection;

    public function jsonSerialize() : array
    {
        return $this->attributes;
    }

    public function __construct(?array $attributes=[])
    {
        $this->attributes = $attributes;
    }

    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    public static function setConnection(Connection $connection)
    {
        static::$connection = $connection->connect();
    }

    public static function get(array $where=[]) : array
    {
        return static::rows(static::$table, $where);
    }

    public static function find(string $column, string $value)
    {
        return static::row(static::$table, $column, $value);
    }

    public static function create(array $data)
    {
        $id = static::insert(static::$table, $data);

        return static::find(static::$primaryKey, $id);
    }

    public static function patch(array $data, array $where=[]) : int
    {
        return static::update(static::$table, $data, $where);
    }

    public static function destroy(array $where, ?int $limit=null) : int
    {
        return static::delete(static::$table, $where, $limit);
    }
}
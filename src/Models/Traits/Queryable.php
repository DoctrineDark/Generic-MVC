<?php

namespace App\Models\Traits;

trait Queryable
{
    public static function raw(string $sql)
    {
        return static::$connection->query($sql);
    }

    public static function query($sql, $params = [])
    {
        $statement = static::$connection->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, static::class);

        foreach ($params as $key => $value) {
            $statement->bindValue(":$key", $value, (is_int($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR));
        }
        $statement->execute($params);

        return $statement;
    }

    protected static function rows($table, $args = [])
    {
        return static::query("SELECT * FROM ".$table, $args)->fetchAll();
    }

    protected static function row($table, $column, $value)
    {
        $res = static::query("SELECT * FROM $table WHERE $column = ?", [$value])->fetch();

        return $res ? $res : null;
    }

    protected static function insert($table, $data)
    {
        $columns = implode(',', array_keys($data));
        $values = array_values($data);

        $placeholders = array_map(function() {
            return '?';
        }, array_keys($data));

        $placeholders = implode(',', array_values($placeholders));

        static::query("INSERT INTO $table ($columns) VALUES ($placeholders)", $values);

        return static::$connection->lastInsertId();
    }

    protected static function update($table, $data, $where)
    {
        $values = [];

        $fieldDetails = null;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key = ?,";
            $values[] = $value;
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $whereDetails = null;
        $i = 0;
        foreach ($where as $key => $value) {
            $whereDetails .= $i == 0 ? "$key = ?" : " AND $key = ?";
            $values[] = $value;
            $i++;
        }

        $statement = static::query("UPDATE $table SET $fieldDetails WHERE $whereDetails", $values);

        return $statement->rowCount();
    }

    protected static function delete($table, $where, $limit = null)
    {
        $values = array_values($where);

        $whereDetails = null;
        $i = 0;
        foreach ($where as $key => $value) {
            $whereDetails .= $i == 0 ? "$key = ?" : " AND $key = ?";
            $i++;
        }

        if (!empty($limit)) {
            $limit = "LIMIT $limit";
        }

        $statement = static::query("DELETE FROM $table WHERE $whereDetails $limit", $values);

        return $statement->rowCount();
    }
}
<?php

namespace App\Models;

class Topic extends Model
{
    protected static $table = 'topics';

    protected static $primaryKey = 'id';

    public static function get(array $where = []): array
    {
        $topics = parent::get($where);

        foreach ($topics as &$topic) {
            $user = User::find('id', $topic->user_id);
            $topic->user = $user;
        }

        return $topics;
    }
}
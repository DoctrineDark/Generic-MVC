<?php

namespace App\Models;

class Post extends Model
{
    protected static $table = 'posts';

    protected static $primaryKey = 'id';

    public static function get(array $where = []): array
    {
        $posts = parent::get($where);

        foreach ($posts as &$post) {
            $user = User::find('id', $post->user_id);
            $topic = Topic::find('id', $post->topic_id);

            $post->user = $user;
            $post->topic = $topic;
        }

        return $posts;
    }
}
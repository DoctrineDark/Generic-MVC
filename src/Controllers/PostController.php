<?php

namespace App\Controllers;

use App\Core\Template\View;
use App\Models\Post;
use App\Controllers\Traits\BringMeBack;
use App\Models\Topic;

class PostController extends Controller
{
    use BringMeBack;

    public function index()
    {
        $posts = Post::get();

        return $this->response->setBody(View::render('posts.feed', [
            'title' => 'Newsfeed',
            'posts' => $posts,
            'request' => $this->request
        ]));
    }

    public function create()
    {
        $user = $this->request->session()->user();

        $topics = Topic::get();
        return $this->response->setBody(View::render('posts.create', [
            'title' => 'Create Post',
            'topics' => $topics,
            'message' => null,
        ]));
    }

    public function store()
    {
        $user = $this->request->session()->user();

        $topicId = $this->request->get('topic_id');
        $title = $this->request->get('title');
        $body = $this->request->get('body');

        if($topicId && $title && $body) {
            Post::create([
                'topic_id' => $topicId,
                'title' => $title,
                'body' => $body,
                'user_id' => $user->id,
            ]);

            $this->response->redirect('/');
        }

        $topics = Topic::get();
        return $this->response->setBody(View::render('posts.create', [
            'title' => 'Create Post',
            'topics' => $topics,
            'message' => 'Try again.'
        ]));
    }
}
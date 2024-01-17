<?php

namespace App\Controllers;

use App\Controllers\Traits\BringMeBack;
use App\Core\Template\View;
use App\Models\Topic;

class TopicController extends Controller
{
    use BringMeBack;

    public function index()
    {
        $topics = Topic::get();

        return $this->response->setBody(View::render('topics.list', [
            'title' => 'Topics',
            'topics' => $topics,
            'request' => $this->request,
        ]));
    }

    public function store()
    {
        $user = $this->request->session()->user();

        $name = $this->request->get('name');

        if($name) {
            Topic::create([
                'name' => $name,
                'user_id' => $user->id,
            ]);

            $this->response->redirect('/topics');
        }

        $topics = Topic::get();
        return $this->response->setBody(View::render('topics.list', [
            'title' => 'Topics',
            'topics' => $topics,
            'request' => $this->request,
        ]));
    }

    public function delete()
    {
        $user = $this->request->session()->user();
        $topicId = $this->request->get('topic');
        $topic = Topic::find('id', $topicId);

        if($topic && $topic->user_id === $user->id) {
            Topic::destroy(['id' => $topic->id]);
        }

        $this->response->redirect('/topics');
    }
}

<?php
$authUser = $request->session()->get('user');
$newUser = $request->session()->get('new_user');
$request->session()->delete('new_user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .auth-links {
            display: flex;
            gap: 20px;
        }

        .auth-link {
            text-decoration: none;
            color: #333;
            padding: 8px;
            border-radius: 4px;
            background-color: #eee;
            transition: background-color 0.3s;
        }

        .auth-link:hover {
            background-color: #ddd;
        }

        .post-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .post-item {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
            transition: box-shadow 0.3s;
        }

        .post-item:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .post-title {
            font-size: 1.4em;
            margin-bottom: 10px;
            color: #333;
        }

        .post-date {
            color: #888;
            font-size: 1em;
            margin-bottom: 8px;
        }

        .post-author {
            font-size: 1em;
            margin-bottom: 8px;
        }

        .post-topic {
            font-size: 1.1em;
            margin-bottom: 8px;
            color: #4285f4;
        }

        .post-body {
            font-size: 1em;
            color: #555;
        }

        .topics-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #136eaf;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .topics-link:hover {
            background-color: #2051af;
        }

        .create-post-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .create-post-link:hover {
            background-color: #45a049;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<h2><?= $title ?></h2>
<?php if(!$authUser) { ?>
<div class="auth-links">
    <a href="/login" class="auth-link">Login</a>
    <a href="/register" class="auth-link">Register</a>
</div>
<?php } else { ?>
<p>@<?= $authUser->username ?></p>
<form class="auth-links" action="/logout" method="post">
    <input type="submit" id="logout" value="logout" name="Logout">
</form>
<?php } ?>
<div class="post-container">
    <?php if($newUser) { ?>
    <div class="alert alert-success">
        Hello, @<?=$newUser->username?> Thank you for registering. Please confirm your email: <a href="/verify/<?=$newUser->remember_token?>">Verify</a>
    </div>
    <?php } ?>
    <?php foreach($posts as $post) { ?>
        <div class="post-item">
            <div class="post-title"><?= $post->title ?></div>
            <div class="post-date"><?= $post->created_at ?></div>
            <div class="post-author">Author: @<?= $post->user ? $post->user->username : '' ?></div>
            <div class="post-topic">Topic: <?= $post->topic ? $post->topic->name : '' ?></div>
            <div class="post-body"><?= $post->body ?></div>
        </div>
    <?php } ?>
</div>
<a href="/topics" class="topics-link">Topics</a>
<a href="/posts/create" class="create-post-link">Create Post</a>
</body>
</html>

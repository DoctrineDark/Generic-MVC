<?php
$user = $request->session()->get('user');
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
        }

        h2 {
            text-align: center;
        }

        .topics-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
            margin-bottom: 8px;
            padding: 10px;
            border-radius: 4px;
        }

        .topic-name {
            flex-grow: 1;
        }

        .delete-button {
            background-color: #d9534f;
            color: white;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c9302c;
        }

        .create-topic-form {
            max-width: 400px;
            margin: 20px auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        .create-button {
            background-color: #5bc0de;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .create-button:hover {
            background-color: #46b8da;
        }
    </style>
</head>
<body>
<a href="/posts">Posts</a>
<h2><?= $title ?></h2>

<div class="topics-container">
    <ul>
        <?php foreach($topics as $topic) { ?>
        <li>
            <span class="topic-name"><?=$topic->name?></span>
            <?php if($user && $user->id === $topic->user_id) { ?>
            <form method="post" action="/topics/<?=$topic->id?>/delete">
                <button class="delete-button">Delete</button>
            </form>
            <?php } ?>
        </li>
        <?php } ?>
    </ul>
</div>
<?php if($user) { ?>
<form class="create-topic-form" action="/topics/create" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <button type="submit" class="create-button">Create Topic</button>
</form>
<?php } ?>
</body>
</html>

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

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
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
<a href="/posts">Posts</a>
<h2><?= $title ?></h2>
<form action="/posts/create" method="post">
    <?php if($message) { ?>
        <div class="alert alert-danger"><?= $message ?></div>
    <?php } ?>

    <label for="topic_id">Select topic:</label>
    <select id="topic_id" name="topic_id" required>
        <?php foreach($topics as $topic) { ?>
            <option value="<?= $topic->id ?>"><?= $topic->name ?></option>
        <?php } ?>
    </select>

    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>

    <label for="body">Post:</label>
    <textarea id="body" name="body" rows="8" required></textarea>

    <button type="submit">Create Post</button>
</form>

</body>
</html>

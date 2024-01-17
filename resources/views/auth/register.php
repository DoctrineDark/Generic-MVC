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
            max-width: 400px;
            margin: 0 auto;
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

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2><?= $title ?></h2>
<div class="auth-links">
    <a href="/login" class="auth-link">Login</a>
</div>
<form action="/register" method="post">
    <label for="username">Username:</label>
    <input value="<?= $request->get('username') ?>" type="text" id="username" name="username" required>

    <label for="email">Email:</label>
    <input value="<?= $request->get('email') ?>" type="email" id="email" name="email" required>

    <label for="name">Name:</label>
    <input value="<?= $request->get('name') ?>" type="text" id="name" name="name">

    <label for="last_name">Last Name:</label>
    <input value="<?= $request->get('last_name') ?>" type="text" id="last_name" name="last_name">

    <label for="password">Password:</label>
    <input value="" type="password" id="password" name="password" required>

    <button type="submit">Register</button>
</form>

</body>
</html>

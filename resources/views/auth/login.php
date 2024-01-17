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

        button:hover {
            background-color: #45a049;
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

        .remember {
            float: left;
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
<div class="auth-links">
    <a href="/register" class="auth-link">Register</a>
</div>
<form action="/login" method="post">
    <?php if($message) { ?>
    <div class="alert alert-danger"><?= $message ?></div>
    <?php } ?>

    <label for="username">Username:</label>
    <input value="<?= $request->get('username') ?>" type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <label for="remember">Remember me</label>
    <input type="checkbox" name="remember" class="remember" id="remember" />

    <button type="submit">Login</button>
</form>

</body>
</html>

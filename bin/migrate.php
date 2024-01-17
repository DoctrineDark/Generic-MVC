<?php
$host = "localhost";
$root = "root";
$database = "mvc";
$password = null;

try {
    $connection = new PDO("mysql:host=$host", $root, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    createDatabase($connection, $database);
    createUsersTable($connection);
    createTopicsTable($connection);
    createPostsTable($connection);

    seedDefaultUser($connection);
    seedDefaultTopic($connection);
    seedDefaultPost($connection);
}
catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

function createDatabase(PDO $connection, $database) {
    $connection->exec("CREATE DATABASE IF NOT EXISTS `$database`;");
    $connection->query("use ".$database);

    print("Database \"".$database."\" has been created.".PHP_EOL);
}

/**
 * @param PDO $connection
 */
function createUsersTable(PDO $connection) {
    $statement = "
            CREATE TABLE users( 
                id INT AUTO_INCREMENT,
                username  VARCHAR(100) NOT NULL, 
                email VARCHAR(100) NOT NULL, 
                email_verified_at TIMESTAMP NULL,
                name VARCHAR(100) NULL,
                last_name VARCHAR(100) NULL,
                password VARCHAR(100) NOT NULL,
                remember_token VARCHAR(100) NULL,
                remember_token_valid_until TIMESTAMP NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY(id)
            )
        ";

    $connection->exec($statement);

    print("Table \"users\" has been created.".PHP_EOL);
}

function createTopicsTable(PDO $connection) {
    $statement = "
            CREATE TABLE topics( 
                id INT AUTO_INCREMENT,
                user_id INT NULL,
                name VARCHAR(100) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY(id)
            )
        ";

    $connection->exec($statement);

    print("Table \"topics\" has been created.".PHP_EOL);
}

function createPostsTable(PDO $connection) {
    $statement = "
            CREATE TABLE posts( 
                id INT AUTO_INCREMENT,
                user_id INT,
                topic_id INT NULL,
                title VARCHAR(255) NULL,
                body TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY(id)
            )
        ";

    $connection->exec($statement);

    print("Table \"topics\" has been created.".PHP_EOL);
}

function seedDefaultUser(PDO $connection) {
    $now = new DateTime();

    $nextMonth = clone $now;
    $nextMonth->modify('+1 month');

    $statement = "
            INSERT INTO users (username, email, email_verified_at, name, last_name, password, remember_token, remember_token_valid_until)
            VALUES (
            'default',
            'def@def', 
            '".$now->format('Y-m-d H:i:s')."', 
            'Def', 
            'Def', 
            '".sha1(12345678)."', 
            '".sha1(rand())."', 
            '".$nextMonth->format('Y-m-d H:i:s')."'
            );
        ";

    $connection->exec($statement);

    print("Default user has been created.".PHP_EOL);
}

function seedDefaultTopic(PDO $connection) {
    $statement = "
            INSERT INTO topics (user_id, name)
            VALUES (1, 'Default');
        ";

    $connection->exec($statement);

    print("Default Topic has been created.".PHP_EOL);
}

function seedDefaultPost(PDO $connection) {
    $statement = "
            INSERT INTO posts (user_id, topic_id, title, body)
            VALUES (1, 1, 'First Post', 'First Post Body');
        ";

    $connection->exec($statement);

    print("Default Post has been created.".PHP_EOL);
}

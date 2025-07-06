<?php

require_once __DIR__ . '/../../config/Config.php';

class User
{
    public static function findByUsername(string $username): ?array
    {
        $dsn = 'mysql:host=' . Config::get('db.host') .
               ';port=' . Config::get('db.port') .
               ';dbname=' . Config::get('db.database') .
               ';charset=utf8mb4';

        $pdo = new PDO($dsn, Config::get('db.username'), Config::get('db.password'), [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }
}

<?php

require_once __DIR__ . '/../config/Config.php';

class Conn
{
    private static ?PDO $db = null;

    public static function get(): PDO
    {
        if (self::$db === null) {
            $dsn = 'mysql:host=' . Config::get('db.host') .
                ';port=' . Config::get('db.port') .
                ';dbname=' . Config::get('db.database') .
                ';charset=utf8mb4';

            $user = Config::get('db.username');
            $pass = Config::get('db.password');

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => 3
            ];

            try {
                self::$db = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                die("Greška kod spajanja na bazu: " . $e->getMessage());
            }
        }

        return self::$db;
    }
}

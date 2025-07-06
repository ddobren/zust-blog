<?php

require_once __DIR__ . '/../config/Config.php';

/**
 * Pokreće sve nove migracije iz /migrations foldera.
 * Već izvršene migracije pamti u tablici `migrations`.
 */
function runMigrations(): void
{
    $dsn = 'mysql:host=' . Config::get('db.host') .
           ';port=' . Config::get('db.port') .
           ';dbname=' . Config::get('db.database') .
           ';charset=utf8mb4';

    $user = Config::get('db.username');
    $pass = Config::get('db.password');

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 3
    ];

    try {
        $db = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        return;
    }

    // Tablica za praćenje migracija
    $db->exec("
        CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            migrated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $executed = $db->query("SELECT migration FROM migrations")->fetchAll(PDO::FETCH_COLUMN) ?: [];

    $migrationPath = __DIR__ . '/../migrations';

    if (!is_dir($migrationPath)) return;

    $files = array_filter(scandir($migrationPath), fn($f) => pathinfo($f, PATHINFO_EXTENSION) === 'php');

    foreach ($files as $file) {
        if (in_array($file, $executed)) continue;

        $migration = require $migrationPath . '/' . $file;

        if (!is_callable($migration)) continue;

        try {
            $migration($db);

            $stmt = $db->prepare("INSERT INTO migrations (migration) VALUES (:migration)");
            $stmt->execute(['migration' => $file]);

        } catch (Throwable $e) {
            if (isset($_GET['debug']) && $_GET['debug'] === 'migrations') {
                echo "Greška u migraciji $file: " . $e->getMessage();
            } else {
                echo "Uspješno izvršene migracije";
            }
        }
    }
}

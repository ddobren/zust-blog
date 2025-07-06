<?php

if (php_sapi_name() !== 'cli') {
    exit("Ova skripta se koristi samo u terminalu (CLI).\n");
}

if ($argc < 2) {
    exit("Korištenje: php make_migration.php ime_migracije\n");
}

$name = $argv[1];
$timestamp = date('Ymd_His');
$filename = $timestamp . '_' . $name . '.php';
$filepath = __DIR__ . '/migrations/' . $filename;

// ...
$template = <<<PHP
<?php

return function (PDO \$db) {
    // Upisi SQL naredbe ovdje, npr:
    /*
    \$db->exec("
        CREATE TABLE IF NOT EXISTS example (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    */
};
PHP;
// ...

if (!file_exists(__DIR__ . '/migrations')) {
    mkdir(__DIR__ . '/migrations', 0777, true);
}

file_put_contents($filepath, $template);
echo "Migracija kreirana: migrations/$filename\n";

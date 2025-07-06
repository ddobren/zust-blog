<?php

return function (PDO $db) {
    $db->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'moderator') NOT NULL DEFAULT 'moderator',
        created_at INT UNSIGNED NOT NULL
    )
");

    // ...
    // Seed prvog admin korisnika ako ne postoji
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :u");
    $stmt->execute(['u' => 'admin']);

    if ($stmt->fetchColumn() == 0) {
        $hash = password_hash(Config::get('adminUser.password'), PASSWORD_DEFAULT);
        $stmt = $db->prepare("
            INSERT INTO users (username, password, role, created_at)
            VALUES (:u, :p, 'admin', :t)
        ");
        $stmt->execute([
            'u' => Config::get('adminUser.username'),
            'p' => $hash,
            't' => time()
        ]);
    }
    // ...
};

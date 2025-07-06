<?php

return function (PDO $db) {
    $db->exec("
        CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            created_by VARCHAR(255) NOT NULL,
            created_at INT UNSIGNED NOT NULL
        )
    ");
};

<?php

return function (PDO $db) {
    $db->exec("
    CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        category_id INT NOT NULL,
        content LONGTEXT NOT NULL,
        thumbnail_path VARCHAR(255) DEFAULT NULL,
        status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
        author_id INT DEFAULT NULL,
        published_at INT UNSIGNED NOT NULL,
        created_at INT UNSIGNED NOT NULL,
        updated_at INT UNSIGNED NOT NULL,
        INDEX idx_posts_author_id (author_id),
        CONSTRAINT posts_ibfk_1
          FOREIGN KEY (author_id) REFERENCES users(id)
          ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
};

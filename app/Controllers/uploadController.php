<?php
// controllers/UploadController.php

class UploadController
{
    public static function uploadImage(): void
    {
        session_start();

        // Provjera da li je file poslan
        if (
            !isset($_FILES['upload']) ||
            $_FILES['upload']['error'] !== UPLOAD_ERR_OK
        ) {
            http_response_code(400);
            echo json_encode(['error' => ['message' => 'Nije poslana datoteka ili je greška pri uploadu.']]);
            exit;
        }

        $file       = $_FILES['upload'];
        $tmpPath    = $file['tmp_name'];
        $originalName = basename($file['name']);
        $ext        = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        // Ograničimo ekstenzije samo na npr. jpg, jpeg, png, gif
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowedExt, true)) {
            http_response_code(400);
            echo json_encode(['error' => ['message' => 'Nedozvoljen format slike.']]);
            exit;
        }

        // Generiramo unikatno ime (npr. timestamp + random) 
        $newName = time() . '_' . bin2hex(random_bytes(5)) . '.' . $ext;
        $destination = __DIR__ . '/../../public/uploads/' . $newName;

        if (!move_uploaded_file($tmpPath, $destination)) {
            http_response_code(500);
            echo json_encode(['error' => ['message' => 'Greška pri spremanju datoteke.']]);
            exit;
        }

        // Tada vratimo JSON s URL‐om (relativno na public root).
        // Pretpostavljamo da web server serviranje public/ mape kao root.
        $url = '/uploads/' . $newName;

        header('Content-Type: application/json');
        echo json_encode(['url' => $url]);
        exit;
    }
}

<?php

require_once __DIR__ . '/../../database/Conn.php';

class categoriesController extends ErrorHandlerSys
{
    public function create()
    {
        // Provjeri je li forma submitana
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['createCategoryBtn'])) {
            header("Location: /cms/dashboard");
            exit;
        }

        $categoryName = trim($_POST['categoryName'] ?? '');

        if ($categoryName === '') {
            self::add('Naziv kategorije ne smije biti prazan.');
            header('Location: /cms/categories');
            exit;
        }

        if (strlen($categoryName) > 30) {
            self::add('Naziv kategorije je predug.');
            header('Location: /cms/categories');
            exit;
        }


        // ... ubacivanje u SQL tablicu
        try {
            $db = Conn::get();

            $stmt = $db->prepare("
    INSERT INTO categories (name, created_by, created_at)
    VALUES (:name, :created_by, :created_at)
            ");

            $stmt->execute([
                'name' => $categoryName,
                'created_by' => Auth::userId() ?? 'system',
                'created_at' => time()
            ]);
        } catch (PDOException $e) {
            self::add('Greška prilikom spremanja kategorije: ' . $e->getMessage());
            header('Location: /cms/categories');
            exit;
        }

        self::success("Kategorija uspješno dodana.");

        // Redirect nakon uspješnog unosa
        header('Location: /cms/categories');
        exit;
    }

    public static function all(): array
    {
        try {
            $db = Conn::get();
            $stmt = $db->query("SELECT * FROM categories ORDER BY created_at DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            ErrorHandlerSys::add("Greška prilikom dohvaćanja kategorija: " . $e->getMessage());
            return [];
        }
    }

    public static function deleteById(int $id): void
    {
        try {
            $db = Conn::get();

            $stmt = $db->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($stmt->rowCount() > 0) {
                ErrorHandlerSys::success("Kategorija je uspješno obrisana.");
            } else {
                ErrorHandlerSys::add("Kategorija s ID-jem $id ne postoji.");
            }
        } catch (PDOException $e) {
            ErrorHandlerSys::add("Greška prilikom brisanja: " . $e->getMessage());
        }

        header('Location: /cms/categories#categories');
        exit;
    }

    public static function getNumPostsById(int $id): int
    {
        try {
            $db = Conn::get();
            $stmt = $db->prepare("SELECT COUNT(*) FROM posts WHERE category_id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            ErrorHandlerSys::add("Greška prilikom dohvaćanja broja postova: " . $e->getMessage());
            return 0;
        }
    }
}

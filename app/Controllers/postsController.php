<?php

class PostsController
{
    public function create()
    {
        $title       = trim($_POST['title'] ?? '');
        $desc        = trim($_POST['desc'] ?? '');
        $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
        $content_raw = $_POST['content'] ?? '';

        $featured     = $_FILES['featured_image'] ?? null;
        $content_imgs = $_FILES['content_images'] ?? null;

        $thumbDir = BASE_PATH . '/public/uploads/thumbnails';
        $postDir  = BASE_PATH . '/public/uploads/posts';

        foreach ([$thumbDir, $postDir] as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }
        }

        $saveImage = function ($file, $dir, $publicPath) {
            if ($file['error'] !== UPLOAD_ERR_OK) {
                return null;
            }
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $name = time() . '-' . bin2hex(random_bytes(6)) . '.' . strtolower($ext);
            $path = $dir . '/' . $name;
            if (move_uploaded_file($file['tmp_name'], $path)) {
                return $publicPath . '/' . $name;
            }
            return null;
        };

        $featured_url = null;
        if ($featured && isset($featured['tmp_name'])) {
            $featured_url = $saveImage($featured, $thumbDir, '/uploads/thumbnails');
        }

        if ($content_imgs && isset($content_imgs['tmp_name'])) {
            if (!is_array($content_imgs['tmp_name'])) {
                $content_imgs = [
                    'name'     => [$content_imgs['name']],
                    'type'     => [$content_imgs['type']],
                    'tmp_name' => [$content_imgs['tmp_name']],
                    'error'    => [$content_imgs['error']],
                    'size'     => [$content_imgs['size']],
                ];
            }

            foreach ($content_imgs['tmp_name'] as $index => $tmp) {
                $file = [
                    'name'     => $content_imgs['name'][$index],
                    'type'     => $content_imgs['type'][$index],
                    'tmp_name' => $content_imgs['tmp_name'][$index],
                    'error'    => $content_imgs['error'][$index],
                    'size'     => $content_imgs['size'][$index],
                ];

                $url = $saveImage($file, $postDir, '/uploads/posts');
                if ($url) {
                    $content_raw = str_replace("__IMG{$index}__", $url, $content_raw);
                }
            }
        }

        $data = [
            'title'         => $title,
            'desc'          => $desc,
            'category_id'   => $category_id,
            'featured_url'  => $featured_url,
            'content_html'  => $content_raw
        ];

        // JSON response preuzima insertPost()
        self::insertPost($data);
    }

    private static function insertPost(array $data)
    {
        $db = Conn::get();

        $now = time();
        $status = "published";
        $author_id = Auth::userId();

        header('Content-Type: application/json');

        try {
            $stmt = $db->prepare("
                INSERT INTO posts (title, description, category_id, content, thumbnail_path, status, author_id, published_at, created_at, updated_at)
                VALUES (:title, :description, :category_id, :content, :thumbnail, :status, :author_id, :published_at, :created_at, :updated_at)
            ");

            $stmt->execute([
                ':title'        => $data['title'],
                ':description'  => $data['desc'],
                ':category_id'  => $data['category_id'],
                ':content'      => $data['content_html'],
                ':thumbnail'    => $data['featured_url'],
                ':status'       => $status,
                ':author_id'    => $author_id,
                ':published_at' => $now,
                ':created_at'   => $now,
                ':updated_at'   => $now,
            ]);

            $insertId = $db->lastInsertId();

            echo json_encode([
                'status'  => 'success',
                'message' => 'Objava spremljena',
                'data'    => [
                    'id'           => $insertId,
                    'title'        => $data['title'],
                    'desc'         => $data['desc'],
                    'category_id'  => $data['category_id'],
                    'featured_url' => $data['featured_url'],
                    'content_html' => $data['content_html'],
                    'status'       => $status,
                    'author_id'    => $author_id,
                    'created_at'   => $now,
                ]
            ]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Greška prilikom spremanja objave',
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function getCategories()
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
}

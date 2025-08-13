<?php

class PostsController
{
    public function create()
    {
        $title       = trim($_POST['title'] ?? '');
        $desc        = trim($_POST['desc'] ?? '');
        $content_raw = $_POST['content'] ?? '';

        $featured     = $_FILES['featured_image'] ?? null;
        $content_imgs = $_FILES['content_images'] ?? null;

        $thumbDir = BASE_PATH . '/public/uploads/thumbnails';
        $postDir  = BASE_PATH . '/public/uploads/posts';

        foreach ([$thumbDir, $postDir] as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true); // or 0777
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
                return $publicPath . '/' . $name; // vraća javni URL
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
            'featured_url'  => $featured_url,
            'content_html'  => $content_raw
        ];

        // DB::table('posts')->insert($data);

        header('Content-Type: application/json');
        echo json_encode([
            'status'  => 'success',
            'message' => 'Objava spremljena',
            'data'    => $data
        ]);
    }
}

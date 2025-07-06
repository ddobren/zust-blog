<?php

class PostsController
{
    public function create()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submitPostBtn'])) {
            header('Location: /cms/posts');
            exit;
        }

        $title   = trim($_POST['title']   ?? '');
        $content = trim($_POST['content'] ?? '');

        if ($title === '' || $content === '') {
            ErrorHandlerSys::add('Naslov i sadržaj moraju biti popunjeni.');
            header('Location: /cms/posts/create#create');
            exit;
        }

        // Obrada featured_image (ako je postavljena)
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            // Npr. pohranite kao /public/uploads/featured_…
            // i stavite ime u varijablu $featuredImageName
            // …
        } else {
            $featuredImageName = null;
        }

        try {
            $db = Conn::get();
            $stmt = $db->prepare("
            INSERT INTO posts 
            (title, content, featured_image, created_by, created_at)
            VALUES (:title, :content, :featured_image, :created_by, :created_at)
        ");
            $stmt->execute([
                'title'          => $title,
                'content'        => $content,
                'featured_image' => $featuredImageName,
                'created_by'     => Auth::userId(),
                'created_at'     => time()
            ]);
        } catch (PDOException $e) {
            ErrorHandlerSys::add('Greška pri spremanju objave: ' . $e->getMessage());
            header('Location: /cms/posts/create#create');
            exit;
        }

        ErrorHandlerSys::success('Objava je uspješno spremljena.');
        header('Location: /cms/posts#create');
        exit;
    }
}

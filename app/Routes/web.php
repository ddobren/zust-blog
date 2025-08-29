<?php

use Routing\Route;

// Static
Route::get('/uploads/thumbnails/{file}', function ($file) {
    $path = BASE_PATH . '/public/uploads/thumbnails/' . $file;

    if (!file_exists($path)) {
        http_response_code(404);
        exit;
    }

    $mime = mime_content_type($path);
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . filesize($path));

    readfile($path);
    exit;
});

Route::get('/uploads/posts/{file}', function ($file) {
    $path = BASE_PATH . '/public/uploads/posts/' . $file;

    if (!file_exists($path)) {
        http_response_code(404);
        exit;
    }

    $mime = mime_content_type($path);
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . filesize($path));

    readfile($path);
    exit;
});

Route::get('/media/{file}', function ($file) {
    $path = BASE_PATH . '/public/media/' . $file;

    if (!file_exists($path)) {
        http_response_code(404);
        exit;
    }

    $mime = mime_content_type($path);
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . filesize($path));

    readfile($path);
    exit;
});
// ================================


Route::get('/', function () {
    View::load('/home.php');
});

Route::get('/about', function () {
    View::load('/about.php');
});

// ...

// Login
Route::get("/cms/login", function () {
    Auth::redirectIfAuthenticated();
    View::load('login.php');
});

Route::post('/cms/login', function () {
    Auth::redirectIfAuthenticated();
    (new AuthController)->login();
});

// ...

Route::get('/cms/logout', function () {
    Auth::redirectIfGuest();
    (new Auth)->logout();
});;

// ...

// Dashboard
Route::get('/cms/dashboard', function () {
    Auth::redirectIfGuest();
    View::renderTemplate('templates/cms.php', 'components/dashboard.php');
});

// ...

// Kategorije
Route::get('/cms/categories', function () {
    Auth::redirectIfGuest();
    View::renderTemplate('templates/cms.php', 'components/categories.php');
});

Route::post('/cms/categories', function () {
    Auth::redirectIfGuest();
    (new categoriesController)->create();
});

Route::get('/cms/categories/delete/{id}', function ($id) {
    Auth::redirectIfGuest();
    (new categoriesController)->deleteById($id);
});

// ...

// Create new post
Route::get('/cms/posts/create', function () {
    Auth::redirectIfGuest();
    View::renderTemplate('templates/cms.php', 'components/postCreate.php');
});

Route::post('/cms/posts/create', function () {
    Auth::redirectIfGuest();

    (new PostsController)->create();
});

// ...

// All posts    
Route::get('/cms/posts', function () {
    Auth::redirectIfGuest();
    View::renderTemplate('templates/cms.php', 'components/allPosts.php');
});

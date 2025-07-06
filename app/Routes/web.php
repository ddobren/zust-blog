<?php

use Routing\Route;


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

    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $img = $_FILES['featured_image'] ?? 'nista';

    foreach ($_POST as $i => $value) {
        echo "<pre>";
        print_r(htmlspecialchars($value));
        echo "</pre>";
    }
});

Route::post('/cms/upload/image', function () {
    Auth::redirectIfGuest();
    UploadController::uploadImage();
});

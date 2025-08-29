<?php 

use Routing\Route;

// cms API
Route::get('/cms/api/posts', function () {
    #Auth::redirectIfGuest();
    (new PostsController)->getPosts();
});

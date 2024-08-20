<?php

use App\Http\Controllers\ControllerArchive;
use App\Http\Controllers\ControllerGroup;
use App\Http\Controllers\ControllerMainPage;
use App\Http\Controllers\ControllerPost;
use App\Http\Controllers\ControllerSettings;
use App\Http\Controllers\ControllerTopics;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// GET requests

Route::get("/", [ControllerMainPage::class, "index"]);

Route::get("/posts", [ControllerPost::class, "index"]);
Route::get("/posts/create", [ControllerPost::class, "formCreatePost"]);
Route::get("/posts/edit/{id}", [ControllerPost::class, "editPost"]);
Route::get("/posts/view/{id}", [ControllerPost::class, "viewPost"]);

Route::get("/permanent", [ControllerArchive::class, "index"]);

Route::get("/topics", [ControllerTopics::class, "index"]);
Route::get("/topics/view/{id}", [ControllerTopics::class, "viewTopic"]);
Route::get("/topics/create", [ControllerTopics::class, "createTopicForm"]);

Route::get("/settings", [ControllerSettings::class, "index"]);
Route::get("/settings/download_all", [ControllerSettings::class, "downloadAll"]);
Route::get("/settings/download_posts", [ControllerSettings::class, "downloadPosts"]);
Route::get("/settings/download_permanents", [ControllerSettings::class, "downloadPermanents"]);
Route::get("/settings/download_topics", [ControllerSettings::class, "downloadTopics"]);
Route::get("/settings/download_posts_permanents", [ControllerSettings::class, "downloadPostsPermanents"]);

// POST requests

Route::post("/posts/create", [ControllerPost::class, "createPost"]);
Route::post("/posts/update/{id}", [ControllerPost::class, "updatePost"]);

Route::post("/comments/add", [ControllerTopics::class, "addComment"]);

Route::post("/topics/create", [ControllerTopics::class, "createTopic"]);

// PUT requests

// ...

// DELETE requests

Route::get("/posts/delete/{id}", [ControllerPost::class, "deletePost"]);

// 404 | Page not found.

Route::fallback(function () {
    return view("/error/404");
});

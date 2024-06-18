<?php

use App\Http\Controllers\ControllerArchive;
use App\Http\Controllers\ControllerGroup;
use App\Http\Controllers\ControllerMainPage;
use App\Http\Controllers\ControllerPost;
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

Route::get("/group", [ControllerGroup::class, "index"]);
Route::get("/posts", [ControllerPost::class, "index"]);
Route::get("/posts/create", [ControllerPost::class, "formCreatePost"]);
Route::get("/posts/edit/{id}", [ControllerPost::class, "editPost"]);
Route::get("/posts/view/{id}", [ControllerPost::class, "viewPost"]);

Route::get("/permanent", [ControllerArchive::class, "index"]);

// POST requests

Route::post("/posts/create", [ControllerPost::class, "createPost"]);
Route::post("/posts/update/{id}", [ControllerPost::class, "updatePost"]);

// PUT requests

// ...

// DELETE requests

Route::get("/posts/delete/{id}", [ControllerPost::class, "deletePost"]);

// 404 | Page not found.

Route::fallback(function () {
    return view("/404");
});

<?php

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

// POST requests

// ...

// PUT requests

// ...

// DELETE requests

// ...
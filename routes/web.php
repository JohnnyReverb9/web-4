<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
//    return view('welcome');
    return 123;
});

Route::get("/main", function () {
    return "welcome";
});

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

// POST requests

Route::post('products', [ProductController::class, 'store']);

// PUT requests

Route::put('products/{id}', [ProductController::class, 'update']);

// DELETE requests

Route::delete('products/{id}', [ProductController::class, 'delete']);

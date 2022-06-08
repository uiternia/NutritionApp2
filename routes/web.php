<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NutritionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/favorite',[FavoriteController::class,'index'])->middleware(['auth:sanctum'])->name('favorite.index');
Route::post('/favorite/{post}',[FavoriteController::class,'add'])->middleware(['auth:sanctum'])->name('favorite.add');
Route::post('/posts/{post}/favorite',[FavoriteController::class,'store'])->middleware(['auth:sanctum'])->name('favorite.store');
Route::post('/posts/{post}/unfavorite',[FavoriteController::class,'delete'])->middleware(['auth:sanctum'])->name('favorite.delete');

Route::get('/mypost',[PostController::class,'mypost'])->middleware(['auth:sanctum'])->name('mypost');
Route::get('/search',[PostController::class,'search'])->middleware(['auth:sanctum'])->name('post.search');
Route::resource('posts',PostController::class)->middleware(['auth:sanctum']);

Route::resource('nutritions',NutritionController::class)->middleware(['auth:sanctum']);

Route::get('/users',[UserController::class,'index'])->middleware('auth:sanctum')->name('users.index');
Route::get('/users/{user}/edit',[UserController::class,'edit'])->middleware(['auth:sanctum'])->name('users.edit');
Route::put('/users{user}',[UserController::class,'update'])->middleware(['auth:sanctum'])->name('users.update');





// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     })->name('dashboard');
// });

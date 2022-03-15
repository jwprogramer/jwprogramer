<?php

use App\Http\Controllers\Admin\ManufController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomePageController::class,"index"])->name('home');

Route::get('/about', [HomePageController::class,"about"])->name('about');
Route::get('/posts', [App\Http\Controllers\PostController::class,"index"])->name('posts');
Route::get('/contact', [ContactController::class,"index"])->name('contact');
Route::post('/contact', [ContactController::class,"send"])->name('contact.send');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    
    
    Route::get('/post/list', [PostController::class,"list"])->name('post.list');
    Route::get('/post', [PostController::class,"create"])->name('post.create');
    Route::post('/post', [PostController::class,"store"])->name('post.store');
    Route::get('/post/{post}', [PostController::class,"edit"])->name('post.edit');
    Route::put("/post/{post}", [PostController::class,"update"])->name('post.update');
    Route::delete('/post/{post}', [PostController::class,"destroy"])->name('post.destroy');
   
});


Route::middleware(['auth','can:admin-access'])->group(function () {
    Route::get('/manufs/list', [ManufController::class,"list"])->name('manufs.list');
    Route::get('/manufs', [ManufController::class,"create"])->name('manufs.create');
    Route::post('/manufs', [ManufController::class,"store"])->name('manufs.store');
    Route::get('/manufs/{manuf}', [ManufController::class,"edit"])->name('manufs.edit');
    Route::put("/manufs/{manuf}", [ManufController::class,"update"])->name('manufs.update');
    Route::delete('/manufs/{manuf}', [ManufController::class,"destroy"])->name('manufs.destroy');



    Route::get('/users/list', [UserController::class,"list"])->name('users.list');
    Route::get('/users/{user}', [UserController::class,"edit"])->name('users.edit');
    Route::post('/users', [UserController::class,"store"])->name('users.store');
    Route::put("/users/{user}", [UserController::class,"update"])->name('users.update');
});
<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/crear-cuenta', [UserController::class, 'create'])->name('register');
Route::post('/crear-cuenta', [UserController::class, 'store']);
// login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
// logout
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
// editar perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');
// posts
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');
// likes
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('posts.likes.destroy');
// followers
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');
// imagenes
Route::post('/imagenes', [ImageController::class, 'store'])->name('imagenes.store');

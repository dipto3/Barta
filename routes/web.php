<?php

use App\Http\Controllers\FrontendControllers\CommentController;
// use App\Http\Controllers\FrontendControllers\LoginController;
// use App\Http\Controllers\FrontendControllers\RegistrationController;
use App\Http\Controllers\FrontendControllers\HomeController;
use App\Http\Controllers\FrontendControllers\PostController;
use App\Http\Controllers\FrontendControllers\ProfileController;
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

require __DIR__.'/auth.php';
//Frontend routes...
// Route::get('/', [LoginController::class, 'login_page']);
// Route::post('/user/login-check', [LoginController::class, 'login']);
// Route::post('/user/logout', [LoginController::class, 'logout']);
// Route::get('/user/registration', [RegistrationController::class, 'create']);
// Route::post('/user/store', [RegistrationController::class, 'store']);

//home page...
Route::get('/home', [HomeController::class, 'home'])->name('home');
//search route...
Route::get('/search', [HomeController::class, 'search'])->name('search');
//profile routes...
Route::get('/profile/user/{uuid}', [ProfileController::class, 'profile'])->name('profile');
Route::get('/profile/{uuid}', [ProfileController::class, 'edit'])->name('profile_edit');
Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile_update');
//post routes...
Route::post('/post/store', [PostController::class, 'store'])->name('postStore');
Route::get('/post/{uuid}', [PostController::class, 'single_post'])->name('singlePost');
Route::get('/post/edit/{uuid}', [PostController::class, 'edit'])->name('postEdit');
Route::put('/post/update/{uuid}', [PostController::class, 'update'])->name('postUpdate');
Route::delete('/post/remove/{id}', [PostController::class, 'delete'])->name('postRemove');
Route::post('/post/like/{id}', [PostController::class, 'like_unlike'])->name('postLike');
//comment routes...
Route::post('/comment/store', [CommentController::class, 'store'])->name('commentStore');
Route::get('/post/{uuid}/comment/{id}/edit', [CommentController::class, 'edit'])->name('commentEdit');
Route::put('/post/comment/{id}/update', [CommentController::class, 'update'])->name('commentUpdate');
Route::delete('/comment/remove/{id}', [CommentController::class, 'delete'])->name('commentRemove');

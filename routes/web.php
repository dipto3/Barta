<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendControllers\LoginController;
use App\Http\Controllers\FrontendControllers\RegistrationController;
use App\Http\Controllers\FrontendControllers\HomeController;
use App\Http\Controllers\FrontendControllers\ProfileController;
use App\Http\Controllers\FrontendControllers\PostController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//Frontend routes...
Route::get('/', [LoginController::class, 'login_page']);
Route::post('/user/login-check', [LoginController::class, 'login']);
Route::post('/user/logout', [LoginController::class, 'logout']);
Route::get('/user/registration', [RegistrationController::class, 'create']);
Route::post('/user/store', [RegistrationController::class, 'store']);
//home page...
Route::get('/home', [HomeController::class, 'home'])->name('home');
//profile routes...
Route::get('/profile/user/{id}', [ProfileController::class, 'profile']);
Route::get('/profile/{id}', [ProfileController::class, 'edit']);
Route::post('/profile/update/{id}', [ProfileController::class, 'update']);
//post routes...
Route::post('/post/store', [PostController::class, 'store'])->name('postStore');
Route::get('/post/{uuid}', [PostController::class, 'single_post'])->name('singlePost');
Route::get('/post/edit/{uuid}', [PostController::class, 'edit'])->name('postEdit');
Route::put('/post/update/{id}', [PostController::class, 'update'])->name('postUpdate');
Route::delete('/post/remove/{id}', [PostController::class, 'delete'])->name('postRemove');

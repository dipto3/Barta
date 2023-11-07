<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendControllers\LoginController;
use App\Http\Controllers\FrontendControllers\RegistrationController;
use App\Http\Controllers\FrontendControllers\HomeController;
use App\Http\Controllers\FrontendControllers\ProfileController;
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

Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/profile', [ProfileController::class, 'profile']);
Route::get('/profile/{id}', [ProfileController::class, 'edit']);
Route::post('/profile/update/{id}', [ProfileController::class, 'update']);

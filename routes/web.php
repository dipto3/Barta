<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendControllers\LoginController;
use App\Http\Controllers\FrontendControllers\RegistrationController;
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
    return view('welcome');
});
//Frontend routes...
Route::get('/user/login', [LoginController::class, 'login_page']);

Route::get('/user/registration', [RegistrationController::class, 'create']);
Route::post('/user/store', [RegistrationController::class, 'store']);

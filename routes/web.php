<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::get('/', function() {
    return view('welcome');
})->name('index');

Route::view('/home', 'app');
Route::view('/app', 'app')->name('app');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');

Route::name('user.')->prefix('user')->group(function() {
    Route::post('/add', [UserController::class, 'addUser'])->name('add');

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [UserController::class, 'getUser'])->name('profile');
        Route::post('/update', [UserController::class, 'updateUser'])->name('update');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('change_pwd');
        Route::delete('/delete', [UserController::class, 'deleteUser'])->name('delete');
    });
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth',  [AuthController::class, 'authenticate'])->name('authenticate');

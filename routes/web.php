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

Route::redirect('/home', '/app', 301);

Route::get('/login', function() {
    return redirect()->route('app.login');
})->name('login');

Route::get('/', function() {
    return view('welcome');
})->name('index');

/* grouped routes */

Route::name('app.')->prefix('app')->group(function() {
    Route::get('/profile', function() {
        return redirect()->route('user.profile');
    })->name('profile');

    Route::view('/', 'app')->name('home');
    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');
});

Route::name('user.')->prefix('user')->group(function() {
    Route::post('/add', [UserController::class, 'addUser'])->name('add');
    Route::post('/auth',  [AuthController::class, 'authenticate'])->name('authenticate');

    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/profile', [UserController::class, 'getUser'])->name('profile');
        Route::post('/update', [UserController::class, 'updateUser'])->name('update');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('change_pwd');
        Route::delete('/delete', [UserController::class, 'deleteUser'])->name('delete');
    });
});

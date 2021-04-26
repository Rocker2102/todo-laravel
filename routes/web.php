<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::view('/app', 'app')->name('app');
Route::view('/login', 'login')->name('login');
Route::view('/register', 'app')->name('register');

Route::get('/get-hash/{pwd}', function($pwd) {
    return Hash::make($pwd);
});

Route::get('/user/{id}', function($id) {
    $auth_id = Auth::id();
    if ($auth_id === (int)$id) {
        return view('app');
    }

    return redirect()->route('profile', $auth_id);
})->where('id', '[0-9]+')->name('profile')->middleware('auth');

Route::post('/auth',  [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

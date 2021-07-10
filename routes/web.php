<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;

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

/* reroutes */
Route::redirect('/home', '/app', 301);

Route::get('/login', function() {
    return redirect()->route('app.login');
})->name('login');

Route::get('/register', function() {
    return redirect()->route('app.register');
})->name('register');


/* main views */
Route::get('/', function() {
    return view('welcome');
})->name('index');


/* app views */
Route::name('app.')->prefix('app')->group(function() {
    Route::get('/profile', function() {
        return redirect()->route('user.profile');
    })->name('profile');

    Route::middleware('guest')->group(function () {
        Route::view('/login', 'login')->name('login');
        Route::view('/register', 'register')->name('register');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', [TodoController::class, 'todoView'])->name('home');
    });

    Route::name('todo.')->prefix('todo')
        ->middleware('auth')->group(function() {
            Route::view('/add', '')->name('add');
            Route::view('/bin', '')->name('bin');
            Route::get('/edit/{id}', [TodoController::class, 'editView'])
                ->where('id', '[0-9]+')->name('edit');
    });
});


/* user backend */
Route::name('user.')->prefix('user')->group(function() {
    Route::middleware('guest')->group(function () {
        Route::post('/add', [UserController::class, 'addUser'])->name('add');
        Route::post('/auth',  [AuthController::class, 'authenticate'])->name('authenticate');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/profile', [UserController::class, 'getUser'])->name('profile');
        Route::post('/update', [UserController::class, 'updateUser'])->name('update');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('change_pwd');
        Route::delete('/delete', [UserController::class, 'deleteUser'])->name('delete');
    });
});


/* todo backend */
Route::name('todo.')->prefix('todo')
    ->middleware('auth')->group(function() {
        Route::get('/get/{id}', [TodoController::class, 'get'])->name('get');
        Route::get('/getAll/{page?}/{items?}', [TodoController::class, 'getAll'])
            ->where([
                'page' => '[0-9]+',
                'items' => '[0-9]+'
            ])->name('getAll');
        Route::post('/add', [TodoController::class, 'add'])->name('add');
        Route::post('/update/{id}', [TodoController::class, 'update'])
            ->where('id', '[0-9]+')->name('update');
        Route::delete('/delete/{id}', [TodoController::class, 'delete'])
            ->where('id', '[0-9]+')->name('delete');
});

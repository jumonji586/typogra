<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
Auth::routes();

Route::get('/',  [PostController::class, 'index'])->name('posts.index');
Route::resource('posts', PostController::class);

Route::get('posts/create/{theme_id}', [PostController::class, 'create'])->name('posts.create.{theme_id}');

Route::get('/posts/detail/{display_id}', [PostController::class, 'show'])->name('posts.show');

Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('{provider}');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}',  [RegisterController::class, 'showProviderUserRegistrationForm'])->name('{provider}');
    Route::post('/{provider}',  [RegisterController::class, 'registerProviderUser'])->name('{provider}');
});

// Route::prefix('posts')->name('posts.')->group(function () {
//     Route::get('/index', [PostController::class, 'index'])->name('index');
// });


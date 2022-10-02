<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
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
Auth::routes();

// posts
Route::get('/',  [PostController::class, 'index'])->name('posts.index');
Route::resource('posts', PostController::class);

Route::get('posts/create/{theme_id}', [PostController::class, 'create'])->name('posts.create.{theme_id}');
Route::get('/posts/detail/{display_id}', [PostController::class, 'show'])->name('posts.show');
Route::put('posts/{post}/like',  [PostController::class, 'like'])->name('posts.like')->middleware('auth');
Route::delete('posts/{post}/like', [PostController::class, 'unlike'])->name('posts.unlike')->middleware('auth');
Route::put('posts/{post}/recommendset',  [PostController::class, 'recommendOn'])->name('posts.recommendOn')->middleware('auth');
Route::delete('posts/{post}/recommendset',  [PostController::class, 'recommendOff'])->name('posts.recommendOff')->middleware('auth');
Route::get('posts/theme/{theme}', [PostController::class, 'theme'])->name('posts.theme.{theme}');

// comment
Route::post('comment/sendcomment', [CommentController::class, 'sendComment'])->name('comment.sendComment');
Route::get('comment/getcomment', [CommentController::class, 'getComment'])->name('comment.getComment');
Route::delete('comment/deletecomment', [CommentController::class, 'deleteComment'])->name('comment.deleteComment');
Route::post('comment/sendsubcomment', [CommentController::class, 'sendSubComment'])->name('comment.sendSubComment');
Route::get('comment/getsubcomment', [CommentController::class, 'getSubComment'])->name('comment.getSubComment');
Route::delete('comment/deletesubcomment', [CommentController::class, 'deleteSubComment'])->name('comment.deleteSubComment');

// users
Route::get('users/detail/{display_id}', [UserController::class, 'Myshow'])->name('users.show');
Route::get('users/edit',  [UserController::class, 'Myedit'])->name('users.edit');
Route::patch('users/{user}', [UserController::class, 'update'])->name('users.update');


// Auth
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


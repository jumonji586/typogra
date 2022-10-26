<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use Illuminate\Auth\Events\OtherDeviceLogout;

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
Route::resource('posts', PostController::class)->except(['show']);

Route::prefix('posts')->name('posts.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::put('/{post}/recommendset',  [PostController::class, 'recommendOn'])->name('recommendOn');
        Route::delete('/{post}/recommendset',  [PostController::class, 'recommendOff'])->name('recommendOff');
        Route::get('/create/{theme_id}', [PostController::class, 'create'])->name('create.{theme_id}');
        Route::put('/{post}/like',  [PostController::class, 'like'])->name('like');
        Route::delete('/{post}/like', [PostController::class, 'unlike'])->name('unlike');
    });
    Route::get('/detail/{display_id}', [PostController::class, 'show'])->name('show');
    Route::get('/theme/{theme}', [PostController::class, 'theme'])->name('theme.{theme}');
    Route::get('/search', [PostController::class, 'search'])->name('search');
    Route::get('/{post}/violation', [PostController::class, 'violation'])->name('violation');
});

// comment
Route::prefix('comment')->name('comment.')->group(function () {
    Route::post('/sendcomment', [CommentController::class, 'sendComment'])->name('sendComment');
    Route::get('/getcomment', [CommentController::class, 'getComment'])->name('getComment');
    Route::delete('/deletecomment', [CommentController::class, 'deleteComment'])->name('deleteComment');
    Route::post('/sendsubcomment', [CommentController::class, 'sendSubComment'])->name('sendSubComment');
    Route::get('/getsubcomment', [CommentController::class, 'getSubComment'])->name('getSubComment');
    Route::delete('/deletesubcomment', [CommentController::class, 'deleteSubComment'])->name('deleteSubComment');
});

// users
Route::prefix('users')->name('users.')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/edit',  [UserController::class, 'Myedit'])->name('edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        Route::put('/{user}/follow', [UserController::class, 'follow'])->name('follow');
        Route::delete('/{user}/follow', [UserController::class, 'unfollow'])->name('unfollow');
        Route::get('/leave/{display_id}', [UserController::class, 'leave'])->name  ('leave');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/info',  [UserController::class, 'info'])->name('info');
    });
    Route::get('/detail/{display_id}', [UserController::class,'Myshow'])->name('show');
    Route::get('/{display_id}/followings', [UserController::class, 'followings'])->name('followings');
    Route::get('/{display_id}/followers', [UserController::class, 'followers']) ->name('followers');
});

// Auth
Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('{provider}');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}',  [RegisterController::class, 'showProviderUserRegistrationForm'])->name('{provider}');
    Route::post('/{provider}',  [RegisterController::class, 'registerProviderUser'])->name('{provider}');
});

// Contact
Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact',  [ContactController::class, 'complete'])->name('contact.complete');

// Other
Route::get('/rule', function () {
    return view('rule');
})->name('rule');
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');


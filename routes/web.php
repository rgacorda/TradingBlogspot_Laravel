<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CommentController;

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


Route::get('/postshow', function () {
    return view('user_func.show_postcom');
});



//Authentication & Registration Routes
Route::post('/register-user',[CustomAuthController::class,'registerUser'])->name('register-user');
Route::post('/login-user',[CustomAuthController::class,'loginUser'])->name('login-user');
Route::get('/dashboard',[CustomAuthController::class, 'dashboard'])->middleware('isLoggedIn');
Route::get('/logout',[CustomAuthController::class,'logout']);

//Posts Routes
Route::resource('post',PostController::class);
Route::post('/delete_post',[PostController::class,'deletePost']);
Route::post('/update_post',[PostController::class,'updatePost']);
Route::get('/search', [PostController::class, 'search'])->name('search');

//User Routes
Route::resource('user',UserProfileController::class);
Route::post('/delete_user',[UserProfileController::class,'deleteUser']);

//Comments Routes
Route::resource('comment',CommentController::class);
Route::post('/delete_comm',[CommentController::class,'deleteComm']);
Route::post('/update_comm',[CommentController::class,'updateComm']);

?>
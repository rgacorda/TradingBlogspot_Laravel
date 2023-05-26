<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

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
    return redirect('/Home');
});


Route::get('/visit', function () {
    return view('user_func.visit_profile');
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
Route::post('/approvePost',[PostController::class,'approvePost']);
Route::post('/rejectPost',[PostController::class,'rejectPost']);
Route::post('/rejectDelete',[PostController::class,'deleteReject']);
Route::post('/promptDelete',[PostController::class,'deletePrompt']);

//User Routes
Route::resource('user',UserProfileController::class);
Route::post('/delete_user',[UserProfileController::class,'deleteUser']);

//Comments Routes
Route::resource('comment',CommentController::class);
Route::post('/delete_comm',[CommentController::class,'deleteComm']);
Route::post('/update_comm',[CommentController::class,'updateComm']);

//Category Routes
Route::get('/Home',[CategoryController::class,'Home']);
Route::get('/LongTerm',[CategoryController::class,'LongTerm']);
Route::get('/ShortTerm',[CategoryController::class,'ShortTerm']);
Route::get('/Intraday',[CategoryController::class,'Intraday']);
Route::get('/LongIdeas',[CategoryController::class,'LongIdeas']);
Route::get('/ShortIdeas',[CategoryController::class,'ShortIdeas']);
Route::get('/Risk',[CategoryController::class,'Risk']);
Route::get('/Tips',[CategoryController::class,'Tips']);
Route::get('/Psychology',[CategoryController::class,'Psychology']);
Route::get('/Secrets',[CategoryController::class,'Secrets']);

//Generate Reports
Route::get('/generate-pdf', [PostController::class, 'generatePDF'])->name('generatePDF');

?>

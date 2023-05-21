<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArticlevoteController;
use App\Http\Controllers\CommentvoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
/*
Route::middleware(['auth'])->group(function () {
    Route::get('/article/create', [ArticleController::class, 'create']);
    Route::post('/article', [ArticleController::class, 'store']);
    Route::get('/article/{article_id}/edit', [ArticleController::class, 'edit']);
    Route::put('/article/{article_id}', [ArticleController::class, 'update']);
    Route::delete('/article/{article_id}', [ArticleController::class, 'destroy']);
});
*/
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*
Route::get('/article', [ArticleController::class, 'list']);
Route::get('/article/{article_id}', [ArticleController::class, 'show']);
*/
Route::resource('article', ArticleController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('profile', ProfileController::class)->only(['index','update']);
    Route::post('/comment/{article_id}', [CommentController::class, 'store']);
    Route::delete('/comment/{article_id}/{comment_id}', [CommentController::class, 'destroy']);
    Route::post('/article/{article_id}/vote', [ArticlevoteController::class, 'store']);
    Route::post('/comment/{article_id}/vote', [CommentvoteController::class, 'store']);

});

Route::get('/in/{nickname}', [ProfileController::class, 'show']);
Route::get('/in/{nickname}/articles', [ProfileController::class, 'showarticle']);

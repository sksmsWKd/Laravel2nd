<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

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


Route::resource('/posts', PostsController::class)->middleware(['auth']);

Route::post('/like/{post}', [LikesController::class, "store"])->middleware(['auth'])->name('like.store');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::delete('/posts/images/{id}', [PostsController::class,]);

Route::post('/commentSave/{post}', [CommentsController::class, "store"]);


Route::get('/commentlist/{postId}', [CommentsController::class, "index"]);
Route::delete('/commentDelete/{id}', [CommentsController::class, "destroy"]);
Route::put('commentUpdate/{id}', [CommentsController::class, "update"]);

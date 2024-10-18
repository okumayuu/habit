<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');

});

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
 
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class,'delete']);
    Route::get('/posts/{post}/edit', [PostController::class, 'edit']);

});

Route::controller(TodoController::class)->middleware(['auth'])->group(function(){
 
    
    Route::post('/todo', [TodoController::class, 'store']);
    Route::delete('/delete/{todo}', [TodoController::class, 'delete']);
    

});

Route::controller(CategoryController::class)->middleware(['auth'])->group(function(){
 
    
    Route::get('/posts/{category}',  [CategoryController::class, 'index'])->name('posts.index');
    Route::post('/posts/{category}', [CategoryController::class, 'store']);
    Route::get('/posts/{category}/create',  [CategoryController::class, 'create']);
    
    
});

Route::controller(TargetController::class)->middleware(['auth'])->group(function(){
    
    Route::post('/posts/{category}/target', [TargetController::class, 'store']);
    Route::get('/posts/{category}/target/edit', [TargetController::class, 'edit'])->name('target.edit');
    Route::put('/target/{category}/update', [TargetController::class, 'update'])->name('target.update');
    
});

Route::controller(LikeController::class)->middleware(['auth'])->group(function(){
    
    Route::post('/posts/{post}/like', [LikeController::class, 'likePost']);
    Route::post('/posts/{post}/unlike', [LikeController::class, 'unlikePost']);
    
});

Route::controller(CommentController::class)->middleware(['auth'])->group(function(){
    
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'delete']);



});




Route::middleware('auth')->group(function () {
    Route::post('/follow/{user}', [FollowController::class,'follow']);
    Route::delete('/unfollow/{user}', [FollowController::class,'unfollow']);
});
require __DIR__.'/auth.php';

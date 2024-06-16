<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\CategoryController;

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
    Route::get('/', [HomeController::class, 'home']);

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
 
    
     Route::get('/posts/{category}',  [CategoryController::class, 'index']);//ここが動いている
    
});

Route::middleware('auth')->group(function () {
    Route::post('/follow/{user}', [FollowController::class,'follow']);
    Route::delete('/unfollow/{user}', [FollowController::class,'unfollow']);
});
require __DIR__.'/auth.php';

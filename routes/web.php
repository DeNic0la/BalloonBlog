<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\StatsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;

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
/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/');
    //return Inertia::render('Dashboard');
})->name('dashboard');

//Blog
    //Index
Route::get('/blog',[BlogController::class, 'index'])->name('blog');
    //Create
Route::middleware(['auth:sanctum', 'verified'])->get('/blog/create',[BlogController::class, 'create']);
    //Edit
Route::middleware(['auth:sanctum', 'verified'])->get('/blog/edit',[BlogController::class, 'edit']);

//WEB-API
Route::middleware(['auth:sanctum', 'verified'])->post('/blog/add',[PostController::class,'add']);
Route::middleware(['auth:sanctum', 'verified'])->post('/blog/update',[PostController::class,'update']);
Route::middleware(['auth:sanctum', 'verified'])->post('/blog/add/image/{post}',[PostController::class,'uploadImage']);

//For Images
Route::get('/image',[FileController::class, 'getImage']);

//Likes
Route::middleware(['auth:sanctum', 'verified'])->post('/like', [LikeController::class, 'like']);
Route::post('/like/info', [LikeController::class, 'info']);

//Stats
Route::get('/stats',[StatsController::class, 'index'])->name('stats');



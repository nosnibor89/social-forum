<?php

use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\PublicProfilesController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ThreadController;
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

Route::redirect('/', 'threads');

//Route::prefix('threads')->group(function () {
//    Route::get('/', [ThreadController::class, 'index'])->name('thread.index');
//    Route::get('/{thread}', [ThreadController::class, 'show'])->name('thread.show');
//
//    //Only auth users can perform
//    Route::middleware('auth')->group(function() {
//        Route::post('/', [ThreadController::class, 'store'])->name('thread.store');
//        Route::post('/{thread}/replies', [ReplyController::class, 'store'])->name('reply.store');
//    });
//});


Route::resource('threads', ThreadController::class)->except('show', 'index');
Route::get('threads/{channel:slug?}', [ThreadController::class, 'index'])->name('threads.index');
Route::get('threads/{channel:slug}/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::resource('threads.replies', ReplyController::class);
Route::post('/replies/{reply}/favorites', [FavoritesController::class, 'store'])->name('replies.favorites.store');


Route::get('/profiles/{user:name}', [PublicProfilesController::class, 'show'])->name('public-profiles.show');
//Route::resources([
//    'threads' => ThreadController::class,
//    'threads.replies' => ReplyController::class
//]);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

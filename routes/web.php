<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\ProfileController;

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
    // ProfileController
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // AlbumController
    Route::get('/obtained', [AlbumController::class, 'getObtained'])->name('albums.obtained');
    Route::get('/wanted', [AlbumController::class, 'getWanted'])->name('albums.wanted');
    Route::post('/{album}/toggle-obtained', [AlbumController::class, 'toggleObtained'])->name('albums.toggleObtained');
    Route::post('/search', [AlbumController::class, 'search'])->name('albums.search');
    Route::resource('albums', AlbumController::class);

    // SerieController (old)
    Route::get('/series', [SerieController::class, 'index'])->name('series.index');
    Route::get('/series/{id}', [SerieController::class, 'show'])->name('series.show');
});

require __DIR__.'/auth.php';

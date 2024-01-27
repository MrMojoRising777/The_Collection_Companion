<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

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

Route::middleware('auth')->group(function () {
    // DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ProfileController
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // AlbumController
    Route::get('/obtained', [AlbumController::class, 'getObtained'])->name('albums.obtained');
    Route::get('/favorite', [AlbumController::class, 'getFavorites'])->name('albums.favorite');
    Route::get('/wanted', [AlbumController::class, 'getWanted'])->name('albums.wanted');
    Route::get('/first_prints', [AlbumController::class, 'getFirstPrints'])->name('albums.firstPrints');
    Route::post('/{album}/toggle-obtained', [AlbumController::class, 'toggleObtained'])->name('albums.toggleObtained');
    Route::post('/{album}/toggle-favorite', [AlbumController::class, 'toggleFavorite'])->name('albums.toggleFavorite');
    Route::post('/{album}/toggle-wanted', [AlbumController::class, 'toggleWanted'])->name('albums.toggleWanted');
    Route::post('/{album}/toggle-first_print', [AlbumController::class, 'toggleFirstPrint'])->name('albums.toggleFirstPrint');
    Route::post('/search', [AlbumController::class, 'search'])->name('albums.search');
    Route::resource('albums', AlbumController::class);

    // SerieController (old)
    Route::get('/series', [SerieController::class, 'index'])->name('series.index');
    Route::get('/series/{id}', [SerieController::class, 'show'])->name('series.show');
});

require __DIR__.'/auth.php';

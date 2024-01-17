<?php

use App\Http\Controllers\SerieController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/comics', [ComicController::class, 'index'])->name('comics.index');
Route::get('/comics/{comic}', [ComicController::class, 'show'])->name('comics.show');
Route::post('/comics/filter', [ComicController::class, 'filter'])->name('comics.filter');

Route::post('/mark-as-obtained/{id}', [ComicController::class, 'markAsObtained'])->name('comics.markAsObtained');
Route::post('/comics/{comic}/toggle-obtained', [ComicController::class, 'toggleObtained'])->name('comics.toggleObtained');

Route::get('/series', [SerieController::class, 'index'])->name('series.index');
Route::get('/series/{id}', [SerieController::class, 'show'])->name('series.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

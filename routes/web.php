<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SerieUserController;
use App\Http\Controllers\CollectionController;
use App\Livewire\Dashboard;
use App\Livewire\Series\Index as SeriesIndex;
use App\Livewire\Series\Show as SeriesShow;
use App\Livewire\Albums\Index as AlbumsIndex;
use App\Livewire\Albums\Show as AlbumsShow;

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

Route::get('/test', function () {
    return view('scan');
});

Route::get('/test-blade', function () {
    return view('test');
});

Route::get('/sw.js', function () {
    return response()->file(public_path('sw.js'));
});

Route::get('sendTitle/{title}', [ISBNController::class, 'setAlbumObtained']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // DashboardController
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    // AlbumController
    Route::resource('albums', AlbumController::class);
    Route::get('/albums', AlbumsIndex::class)->name('albums.index');
    Route::get('/albums/{album}', AlbumsShow::class)->name('albums.show');;

    // collections view
    Route::get('/collection', [CollectionController::class, 'index'])->name('collection.albums.index');
    // albums
    Route::get('/collection/albums', [CollectionController::class, 'indexAlbums'])->name('collection.albums.index');
    Route::get('/collection/show/album/{album}', [CollectionController::class, 'show'])->name('collection.albums.show');
    Route::get('/collection/edit/album/{album}', [CollectionController::class, 'edit'])->name('collection.albums.edit');
    Route::put('/collection/update/album/{album}', [CollectionController::class, 'update'])->name('collection.albums.update');
    Route::delete('/collection/remove/album/{album}', [CollectionController::class, 'removeFromCollection'])->name('collection.albums.removeFromCollection');
    Route::post('/collection/toggleFavorite/album/{album}', [CollectionController::class, 'toggleFavorite'])->name('collection.albums.toggleFavorite');
    Route::get('/collection/favorites', [CollectionController::class, 'getFavorites'])->name('collection.albums.favorites');
    Route::post('/collection/toggleFirstPrint/album/{album}', [CollectionController::class, 'toggleFirstPrint'])->name('collection.albums.toggleFirstPrint');
    Route::get('/collection/first_prints', [CollectionController::class, 'getFirstPrints'])->name('collection.albums.first_prints');

    // SerieUserController
    Route::get('/collection-series', [SerieUserController::class, 'index'])->name('collection.series.index');

    // SerieController
    Route::get('/series', SeriesIndex::class)->name('series.index');
    Route::get('/series/{serie}', SeriesShow::class)->name('series.show');
    Route::post('/search-series', [SerieController::class, 'search'])->name('series.search');
    Route::match(['post', 'delete'], '/series/{serie}/toggleTracking', [SerieController::class, 'toggleTracking'])->name('series.toggleTracking');


    // wishlist
    Route::get('/wishlist', [AlbumController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/{album}', [AlbumController::class, 'toggleWishlist'])->name('wishlist.toggleWishlist');
    Route::delete('/wishlist/remove/{album}', [AlbumController::class, 'remove'])->name('wishlist.remove');

    //albums view
    Route::match(['post', 'delete'], '/collection/toggle/{album}', [CollectionController::class, 'toggleCollection'])->name('albums.toggleCollected');

    // ProfileController
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Show contact form
    Route::get('/contact/form', [ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.submit');
});

require __DIR__.'/auth.php';

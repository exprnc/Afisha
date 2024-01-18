<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\EventPerformerController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\SubgenreController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WatchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfishaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerformerController;
use App\Http\Controllers\Auth\RegisterController;



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

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/', [AfishaController::class, 'index'])->name('afisha.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('event.show');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genre.show');
Route::get('/performer/{performer}', [PerformerController::class, 'show'])->name('performer.show');
Route::get('/places/{place}', [PlaceController::class, 'show'])->name('place.show');
Route::get('/signout', [UserController::class, 'signout'])->name('signout');

Route::group(['middleware' => 'auth.custom'], function () {
    Route::get('/me/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/events/{event}/like', [FavoriteController::class, 'likeEvent'])->name('favorite.likeEvent');
    Route::post('/events/{event}/dislike', [FavoriteController::class, 'disLikeEvent'])->name('favorite.disLikeEvent');
    Route::get('/me', [UserController::class, 'index'])->name('me.index');
    Route::get('/me/delete', [UserController::class, 'delete'])->name('me.delete');
    Route::patch('/me/{user}', [UserController::class, 'update'])->name('me.update');
    Route::get('/my/tickets', [TicketController::class, 'index'])->name('ticket.index');
    Route::post('/ticket/create/{event}', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket/delete/{event}', [TicketController::class, 'delete'])->name('ticket.delete');
    Route::get('/my/watched', [WatchController::class, 'index'])->name('watch.index');
});

Route::group(['middleware' => ['auth.custom', 'admin']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/event/create', [AdminController::class, 'createEvent'])->name('admin.createEvent');
    Route::patch('/admin/event/update/{event}', [AdminController::class, 'updateEvent'])->name('admin.updateEvent');
    Route::get('/admin/event/update/{event}', [AdminController::class, 'updateIndex'])->name('admin.updateIndex');
    Route::post('/admin/event/delete/{event}', [AdminController::class, 'deleteEvent'])->name('admin.deleteEvent');
    
    Route::get('/admin/genres', [GenreController::class, 'showGenres'])->name('admin.showGenres');
    Route::post('/admin/genre/create', [GenreController::class, 'createGenre'])->name('admin.createGenre');
    Route::get('/admin/genre/update/{genre}', [GenreController::class, 'updateGenre'])->name('admin.updateGenre');
    Route::patch('/admin/genre/update/{genre}', [GenreController::class, 'updateGenre2'])->name('admin.updateGenre2');
    Route::post('/admin/genre/delete/{genre}', [GenreController::class, 'deleteGenre'])->name('admin.deleteGenre');
    
    Route::get('/admin/subgenres', [SubgenreController::class, 'showSubgenres'])->name('admin.showSubgenres');
    Route::post('/admin/subgenre/create', [SubgenreController::class, 'createSubgenre'])->name('admin.createSubgenre');
    Route::get('/admin/subgenre/update/{subgenre}', [SubgenreController::class, 'updateSubgenre'])->name('admin.updateSubgenre');
    Route::patch('/admin/subgenre/update/{subgenre}', [SubgenreController::class, 'updateSubgenre2'])->name('admin.updateSubgenre2');
    Route::post('/admin/subgenre/delete/{subgenre}', [SubgenreController::class, 'deleteSubgenre'])->name('admin.deleteSubgenre');
    
    Route::get('/admin/performers', [PerformerController::class, 'showPerformers'])->name('admin.showPerformers');
    Route::post('/admin/performer/create', [PerformerController::class, 'createPerformer'])->name('admin.createPerformer');
    Route::get('/admin/performer/update/{performer}', [PerformerController::class, 'updatePerformer'])->name('admin.updatePerformer');
    Route::patch('/admin/performer/update/{performer}', [PerformerController::class, 'updatePerformer2'])->name('admin.updatePerformer2');
    Route::post('/admin/performer/delete/{performer}', [PerformerController::class, 'deletePerformer'])->name('admin.deletePerformer');
    
    Route::get('/admin/events-performers', [EventPerformerController::class, 'showEventsPerformers'])->name('admin.showEventsPerformers');
    Route::post('/admin/event-performer/create', [EventPerformerController::class, 'createEventPerformer'])->name('admin.createEventPerformer');
    Route::get('/admin/event-performer/update/{eventPerformer}', [EventPerformerController::class, 'updateEventPerformer'])->name('admin.updateEventPerformer');
    Route::patch('/admin/event-performer/update/{eventPerformer}', [EventPerformerController::class, 'updateEventPerformer2'])->name('admin.updateEventPerformer2');
    Route::post('/admin/event-performer/delete/{eventPerformer}', [EventPerformerController::class, 'deleteEventPerformer'])->name('admin.deleteEventPerformer');
    
    Route::get('/admin/places', [PlaceController::class, 'showPlaces'])->name('admin.showPlaces');
    Route::post('/admin/place/create', [PlaceController::class, 'createPlace'])->name('admin.createPlace');
    Route::get('/admin/place/update/{place}', [PlaceController::class, 'updatePlace'])->name('admin.updatePlace');
    Route::patch('/admin/place/update/{place}', [PlaceController::class, 'updatePlace2'])->name('admin.updatePlace2');
    Route::post('/admin/place/delete/{place}', [PlaceController::class, 'deletePlace'])->name('admin.deletePlace');
    
    Route::get('/admin/cities', [CityController::class, 'showCities'])->name('admin.showCities');
    Route::post('/admin/city/create', [CityController::class, 'createCity'])->name('admin.createCity');
    Route::get('/admin/city/update/{city}', [CityController::class, 'updateCity'])->name('admin.updateCity');
    Route::patch('/admin/city/update/{city}', [CityController::class, 'updateCity2'])->name('admin.updateCity2');
    Route::post('/admin/city/delete/{city}', [CityController::class, 'deleteCity'])->name('admin.deleteCity');
});
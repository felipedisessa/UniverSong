<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // songs region
    Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
    Route::get('/songs/{song}', [SongController::class, 'show'])->name('songs.show');
    Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
    Route::get('/songs/{song}/edit', [SongController::class, 'edit'])->name('songs.edit');
    Route::put('/songs/{song}', [SongController::class, 'update'])->name('songs.update');
    Route::delete('/songs/{song}', [SongController::class, 'destroy'])->name('songs.destroy');
    // end region

    // translations region
    Route::get('/songs/{song}/translations/create', [TranslationController::class, 'create'])->name('songs.translations.create');
    Route::post('/songs/{song}/translations', [TranslationController::class, 'store'])->name('songs.translations.store');
    Route::get('/songs/{song}/translations/edit', [TranslationController::class, 'edit'])->name('songs.translations.edit');
    Route::put('/songs/{song}/translations', [TranslationController::class, 'update'])->name('songs.translations.update');
    // end region
});

require __DIR__.'/auth.php';

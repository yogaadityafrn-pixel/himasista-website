<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/berita/{slug}', [PublicController::class, 'showPost'])->name('berita.show');
Route::get('/acara/{slug}', [PublicController::class, 'showEvent'])->name('acara.show');
Route::post('/kontak-store', [PublicController::class, 'storeKontak'])->name('kontak.store');

Route::get('/berita', [PublicController::class, 'arsipBerita'])->name('berita.index');
Route::get('/acara', [PublicController::class, 'arsipAcara'])->name('acara.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

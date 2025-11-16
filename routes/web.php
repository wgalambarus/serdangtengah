<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelamarController;
use Illuminate\Support\Facades\Route;

// 🏠 Halaman Utama — Bisa diakses semua orang
Route::view('/', 'auth.login')->name('home');

// 🔒 Semua route berikut hanya untuk user yang login & verified
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::view('/dashboard', 'main.dashboard')->name('dashboard');

    // Resource Pelamar (CRUD Pelamar)
    Route::resource('pelamar', PelamarController::class);

    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

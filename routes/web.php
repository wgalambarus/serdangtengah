<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeWizardController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

// 🏠 Halaman Utama — Bisa diakses semua orang
Route::view('/', 'auth.login')->name('home');


// 🔒 Semua route berikut hanya untuk user yang login & verified
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::view('/dashboard', 'main.dashboard')->name('dashboard');

    // Resource Pelamar (CRUD Pelamar)
    Route::resource('pelamar', PelamarController::class);
    Route::resource('/lowongan', PositionController::class);
    Route::get('/lowongan/{id}/applicants', [PositionController::class, 'applicants'])->name('lowongan.applicants');
    Route::put('/lowongan/{id}/disable', [PositionController::class, 'disable'])->name('lowongan.disable');
    Route::put('/lowongan/{id}/enable', [PositionController::class, 'enable'])->name('lowongan.enable');


    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('employee', EmployeeController::class);

    Route::prefix('karyawan/create')->group(function () {
    Route::get('/', [EmployeeWizardController::class, 'index'])->name('employee.create.index');
    Route::post('/finish', [EmployeeWizardController::class, 'finish'])->name('employee.create.finish');
    Route::get('/{step}', [EmployeeWizardController::class, 'show'])->name('employee.create.step');
    Route::post('/{step}', [EmployeeWizardController::class, 'storeStep'])->name('employee.create.store');
    Route::get('/review', [EmployeeWizardController::class, 'review'])->name('employee.create.review');


});

});



require __DIR__.'/auth.php';

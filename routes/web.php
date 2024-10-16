<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\ReceitaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LembreteController;


// Redirect root to profile
Route::get('/', fn() => redirect('/dashboard'));

require __DIR__ . '/auth.php';

// Authenticated and verified routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/lembrete/create', [LembreteController::class, 'create'])->name('lembrete.create');
    Route::post('/lembrete', [LembreteController::class, 'store'])->name('lembrete.store');
});

Route::middleware(['checkIfDoctor'])->group(function () {
    Route::resource('/doctor', DoctorController::class);
    Route::get('/receita/create', [ReceitaController::class, 'create'])->name('receita.create');
    Route::post('/receita/store', [ReceitaController::class, 'store'])->name('receita.store');
    Route::get('/patient/create', [PatientController::class, 'create'])->name('patient.create');
});
Route::middleware(['checkIfPatient'])->group(function () {
    Route::resource('/patient', PatientController::class)->except(['create']);
});
Route::middleware(['checkIfPharmacist'])->group(function () {
    Route::resource('/pharmacist', PharmacistController::class);
    Route::get('/patient/create', [PatientController::class, 'create'])->name('patient.create');
});

// Authenticated profile and ticket routes
Route::middleware('auth')->group(function () {
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

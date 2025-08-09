<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdultoMayorController;
use App\Http\Controllers\AdultoMayorWizardController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Grupo protegido por Jetstream (login + email verificado)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {        
        return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
    
    // CRUD Adultos Mayores
    Route::resource('adultos', AdultoMayorController::class);
    
    
    Route::resource('admin/users', UserController::class)->except(['show']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Wizard de registro de adultos mayores
    Route::prefix('registro-adulto')->name('wizard.')->group(function () {
        Route::get('/paso-1', [AdultoMayorWizardController::class, 'paso1'])->name('paso1');
        Route::post('/paso-1', [AdultoMayorWizardController::class, 'guardarPaso1'])->name('paso1.post');

        Route::get('/paso-2', [AdultoMayorWizardController::class, 'paso2'])->name('paso2');
        Route::post('/paso-2', [AdultoMayorWizardController::class, 'guardarPaso2'])->name('paso2.post');

        Route::get('/paso-3', [AdultoMayorWizardController::class, 'paso3'])->name('paso3');
        Route::post('/paso-3', [AdultoMayorWizardController::class, 'guardarPaso3'])->name('paso3.post');

        Route::get('/paso-4', [AdultoMayorWizardController::class, 'paso4'])->name('paso4');
        Route::post('/paso-4', [AdultoMayorWizardController::class, 'guardarPaso4'])->name('paso4.post');

        Route::get('/paso-5', [AdultoMayorWizardController::class, 'paso5'])->name('paso5');
        Route::post('/paso-5', [AdultoMayorWizardController::class, 'guardarPaso5'])->name('paso5.post');

        Route::get('/paso-6', [AdultoMayorWizardController::class, 'paso6'])->name('paso6');
        Route::post('/paso-6', [AdultoMayorWizardController::class, 'guardarPaso6'])->name('paso6.post');

        Route::get('/confirmar', [AdultoMayorWizardController::class, 'confirmar'])->name('confirmar');
        Route::post('/finalizar', [AdultoMayorWizardController::class, 'finalizar'])->name('finalizar');
    });
});

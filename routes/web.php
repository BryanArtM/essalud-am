<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdultoMayorController;
use App\Http\Controllers\AdultoMayorWizardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('adultos', AdultoMayorController::class);
Route::get('/adultos/{id}', [AdultoMayorController::class, 'show'])->name('adultos.show');
Route::get('adultos/{adulto}/edit', [AdultoMayorController::class, 'edit'])->name('adultos.edit');


Route::prefix('registro-adulto')->group(function () {
    Route::get('/paso-1', [AdultoMayorWizardController::class, 'paso1'])->name('wizard.paso1');
    Route::post('/paso-1', [AdultoMayorWizardController::class, 'guardarPaso1'])->name('wizard.paso1.post');

    Route::get('/paso-2', [AdultoMayorWizardController::class, 'paso2'])->name('wizard.paso2');
    Route::post('/paso-2', [AdultoMayorWizardController::class, 'guardarPaso2'])->name('wizard.paso2.post') ;

    Route::get('/paso-3', [AdultoMayorWizardController::class, 'paso3'])->name('wizard.paso3');
    Route::post('/paso-3', [AdultoMayorWizardController::class, 'guardarPaso3'])->name('wizard.paso3.post');

    Route::get('/paso-4', [AdultoMayorWizardController::class, 'paso4'])->name('wizard.paso4');
    Route::post('/paso-4', [AdultoMayorWizardController::class, 'guardarPaso4'])->name('wizard.paso4.post');

    Route::get('/paso-5', [AdultoMayorWizardController::class, 'paso5'])->name('wizard.paso5');
    Route::post('/paso-5', [AdultoMayorWizardController::class, 'guardarPaso5'])->name('wizard.paso5.post');

    Route::get('/paso-6', [AdultoMayorWizardController::class, 'paso6'])->name('wizard.paso6');
    Route::post('/paso-6', [AdultoMayorWizardController::class, 'guardarPaso6'])->name('wizard.paso6.post');

    Route::get('/confirmar', [AdultoMayorWizardController::class, 'confirmar'])->name('wizard.confirmar');

    Route::post('/finalizar', [AdultoMayorWizardController::class, 'finalizar'])->name('wizard.finalizar');
});







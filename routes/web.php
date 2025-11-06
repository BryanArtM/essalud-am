<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdultoMayorController;
use App\Http\Controllers\AdultoMayorWizardController;
use App\Http\Controllers\UserController;

// Redirigir raíz al dashboard
Route::middleware(['auth', 'verified'])->get('/', function () {
    return redirect()->route('dashboard');
});

// Grupo protegido por Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD Adultos Mayores
    Route::resource('adultos', AdultoMayorController::class);

    // Generar PDF de adulto mayor
    Route::get('adultos/{id}/pdf', [AdultoMayorController::class, 'generatePDF'])->name('adultos.pdf');

    // Administración (solo admins)
    Route::middleware('isAdmin')->group(function () {
        // Panel de administración
        Route::get('/administracion', function () {
            return view('admin.index');
        })->name('admin.index');
        
        // Gestión de usuarios
        Route::resource('admin/users', UserController::class);
        
        // Gestión de caché
        Route::post('admin/cache/clear/{type}', [UserController::class, 'clearCache'])->name('admin.cache.clear');
        Route::post('admin/cache/optimize', [UserController::class, 'optimizeApp'])->name('admin.cache.optimize');
    });

    // Wizard de registro de adultos mayores
    Route::prefix('registro-adulto')->name('wizard.')->group(function () {
        Route::get('/paso-1/{adulto_id?}', [AdultoMayorWizardController::class, 'paso1'])->name('paso1');
        Route::post('/paso-1/{adulto_id?}', [AdultoMayorWizardController::class, 'guardarPaso1'])->name('paso1.post');

        Route::get('/paso-2/{adulto_id?}', [AdultoMayorWizardController::class, 'paso2'])->name('paso2');
        Route::post('/paso-2/{adulto_id?}', [AdultoMayorWizardController::class, 'guardarPaso2'])->name('paso2.post');

        Route::get('/paso-3/{adulto_id?}', [AdultoMayorWizardController::class, 'paso3'])->name('paso3');
        Route::post('/paso-3/{adulto_id?}', [AdultoMayorWizardController::class, 'guardarPaso3'])->name('paso3.post');

        Route::get('/paso-4/{adulto_id?}', [AdultoMayorWizardController::class, 'paso4'])->name('paso4');
        Route::post('/paso-4/{adulto_id?}', [AdultoMayorWizardController::class, 'guardarPaso4'])->name('paso4.post');

        Route::get('/paso-5/{adulto_id?}', [AdultoMayorWizardController::class, 'paso5'])->name('paso5');
        Route::post('/paso-5/{adulto_id?}', [AdultoMayorWizardController::class, 'guardarPaso5'])->name('paso5.post');

        Route::get('/paso-6/{adulto_id?}', [AdultoMayorWizardController::class, 'paso6'])->name('paso6');
        Route::post('/paso-6/{adulto_id?}', [AdultoMayorWizardController::class, 'guardarPaso6'])->name('paso6.post');

        Route::get('/confirmar/{adulto_id?}', [AdultoMayorWizardController::class, 'confirmar'])->name('confirmar');
        Route::post('/finalizar/{adulto_id?}', [AdultoMayorWizardController::class, 'finalizar'])->name('finalizar');
    });
});
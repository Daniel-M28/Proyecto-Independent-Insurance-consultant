<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CertificadoController;

use App\Http\Controllers\RegulatorioController;
use App\Http\Controllers\FactoringController;

use App\Http\Controllers\CommercialRequestController;
 
use App\Http\Controllers\Admin\CommercialAdminController;
use App\Http\Controllers\Admin\PersonalQuoteController;


Route::get('/', function () {
    return view('welcome');
});

//Acceder a vista de administrador
Route::middleware(['auth', 'verified', 'can:admin.users.index'])
    ->resource('users', UserController::class)
    ->names('admin.users');

//Certificados
Route::get('/certificados', [CertificadoController::class, 'index'])->name('certificados.index');
Route::post('/certificados', [CertificadoController::class, 'store'])->name('certificados.store');
Route::delete('/certificados', [CertificadoController::class, 'destroy'])->name('certificados.destroy');
Route::post('/certificados/send-pdf', [CertificadoController::class, 'sendPdf'])->name('certificados.sendPdf');





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/get_quote', function () {
    return view('quote');
})->name('quote');

Route::get('/nueva_compañia', function () {
    return view('nueva_compañia');
})->name('nueva_compañia');

Route::get('/regulatorios_form', function () {
    return view('regulatorios');
})->name('regulatorios_form');

Route::get('/factoring', function () {
    return view('factoring');
})->name('factoring');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//formulario regulatorios


Route::get('/admin/regulatorios', [RegulatorioController::class, 'index'])
    ->name('admin.regulatorios');


 Route::resource('regulatorios', RegulatorioController::class);





//formulario factoring
// Guardar solicitud
Route::post('/factoring', [FactoringController::class, 'store'])->name('factoring.store');

// (Opcional) Listar solicitudes en panel admin
Route::get('/admin/factoring', [FactoringController::class, 'index'])->name('admin.factoring');

Route::resource('factorings', FactoringController::class);

require __DIR__.'/auth.php';


//formulario commercial quote


Route::post('/commercial-request', [CommercialRequestController::class, 'store'])
     ->name('commercial.store');

     Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/commercial-requests', [CommercialAdminController::class, 'index'])
         ->name('commercial.index');

    Route::get('/commercial-requests/{id}', [CommercialAdminController::class, 'show'])
         ->name('commercial.show');

    Route::delete('/commercial-requests/{id}', [CommercialAdminController::class, 'destroy'])
     ->name('commercial.destroy');
});





//forumulario personal quote


Route::prefix('admin')->group(function () {
    Route::get('/personal-quotes', [PersonalQuoteController::class, 'index'])
        ->name('admin.personal-quotes.index');

    Route::get('/personal-quotes/{id}', [PersonalQuoteController::class, 'show'])
        ->name('admin.personal-quotes.show');

    Route::post('/personal-quotes', [PersonalQuoteController::class, 'store'])
        ->name('admin.personal-quotes.store');

    Route::delete('/personal-quotes/{id}', [PersonalQuoteController::class, 'destroy'])
     ->name('admin.personal-quotes.destroy');
});

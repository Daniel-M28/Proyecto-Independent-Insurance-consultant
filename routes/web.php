<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/get_quote', function () {
    return view('quote');
})->name('quote');

Route::get('/nueva_compañia', function () {
    return view('nueva_compañia');
})->name('nueva_compañia');

Route::get('/regulatorios', function () {
    return view('regulatorios');
})->name('regulatorios');

Route::get('/factoring', function () {
    return view('factoring');
})->name('factoring');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

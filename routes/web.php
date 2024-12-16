<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

// Ruta principal para redirigir según el rol
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'student') {
            return redirect()->route('layouts.student');
        } elseif (auth()->user()->role === 'admin') {
            return redirect()->route('projects.index');
        }
    }
    return redirect('/login');
})->name('home');

// Rutas protegidas por middleware
Route::middleware(['auth'])->group(function () {
    // Ruta para estudiantes
    Route::get('/student', function () {
        return view('layouts.student');
    })->name('layouts.student'); // Asegúrate de que esta ruta esté definida

    // Rutas para administradores
    Route::middleware('role:admin')->group(function () {
        Route::resource('projects', ProjectController::class);
    });
});


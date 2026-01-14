<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('home');
});

// API endpoints
// aqui se agregan todas las rutas para mostrar en los views
Route::get('/api/infos', [InfoController::class, 'index']);
Route::get('/api/usuarios', [UsuarioController::class, 'index']);

// Add your app routes above the fallback

Route::fallback(function () {
    \Log::warning('404 fallback: ' . request()->path());
    return response()->view('errors.404', [], 404);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\PruebasMapaController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Página principal personalizada
Route::get('/prin', function () {
    return view('components.principal');
});

// Rutas de Roles
Route::resource('rol', RolController::class);
Route::get('/rolesEliminados', [RolController::class, 'show'])->name('roles.Eliminados');
Route::put('/rolcambiarEstado/{rol}/{estado}', [RolController::class, 'CambiarEstado'])->name('rol.estado');

// Rutas de Proveedores
Route::resource('prove', ProveedorController::class);
Route::get('/prove/eliminados', [ProveedorController::class, 'Eliminados'])->name('proveedores.eliminados');
Route::put('/provecambiarEstado/{prove}/{estado}', [ProveedorController::class, 'cambiarEstado'])->name('proveedores.cambiarEstado');

// Rutas de Clientes
Route::resource('clientes', ClientesController::class);
Route::get('/eliminados', [ClientesController::class, 'Eliminados'])->name('clientes.eliminados');
Route::put('/clientecambiarEstado/{cliente}/{estado}', [ClientesController::class, 'cambiarEstado'])->name('clientes.cambiarEstado');

Route::resource('admin_user', AdminUserController::class);
Route::get('/mapa', function () {
    // Coordenadas fijas para el ejemplo (usuario y trabajador)
    $userCoords = ['lat' => 4.710989, 'lng' => -74.072090]; // Bogotá
    $workerCoords = ['lat' => 4.687912, 'lng' => -74.041992]; // Otro punto en Bogotá

    // Pasamos las coordenadas a la vista
    return view('pruebas.pruebas', compact('userCoords', 'workerCoords'));
});
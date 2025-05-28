<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Models\Trabajadores;

Route::post('/actualizar-ubicacion', function(Request $request) {
    Log::info('Ubicación:', [
        'lat' => $request->latitude,
        'lng' => $request->longitude
    ]);

    // Puedes buscar al trabajador por ID o por correo
    $trabajador = null;

    if ($request->has('trabajador_id')) {
        $trabajador = Trabajadores::find($request->trabajador_id);
    } elseif ($request->has('correo')) {
        $trabajador = Trabajadores::where('correo', $request->correo)->first();
    }

    if ($trabajador) {
        $trabajador->latitude = $request->latitude;
        $trabajador->longitude = $request->longitude;
        $trabajador->save();
        return response()->json(['ok' => true]);
    }

    return response()->json(['ok' => false, 'msg' => 'Trabajador no encontrado'], 404);
});
// routes/api.php


Route::get('/trabajadores', function () {
    // Obtener todos los trabajadores con sus ubicaciones
    $trabajadores = Trabajadores::all(['id', 'nombre', 'latitud', 'longitud']);

    return response()->json($trabajadores);
});


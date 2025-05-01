<?php	

// app/Http/Controllers/PruebasMapaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebasMapaController extends Controller
{
    public function index()
    {
        $cliente = ['lat' => 4.710989, 'lng' => -74.072090];
        $trabajador = ['lat' => 4.653332, 'lng' => -74.083652];
        $distancia = $this->calcularDistancia(
            $cliente['lat'], $cliente['lng'],
            $trabajador['lat'], $trabajador['lng']
        );

        return view('pruebas.pruebas', compact('cliente', 'trabajador', 'distancia'));
    }

    private function calcularDistancia($lat1, $lon1, $lat2, $lon2)
    {
        $radio = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) ** 2 +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return round($radio * $c, 2);
    }
}

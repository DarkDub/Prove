<?php

namespace App\Http\Controllers;

use App\Models\Trabajadores;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;

class PruebasTrabajadores extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trabajadores = Trabajadores::all();
        return view('pruebas.index', compact('trabajadores'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //     $request->validate([

    //     ])

    Trabajadores::create($request->only(
        'nombre', 'correo', 'skill', 'latitude', 'longitude'
    ));
    return redirect()->back()->with('success', 'Trabajador registrado con ubicación');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function MostrarMapa(){
        $trabajadores = Trabajadores::whereNotNull('latitude')->whereNotNull('longitude')->get();

        return view('pruebas.pruebas', compact('trabajadores'));
 ;  }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

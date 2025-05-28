<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rols')->insert([
            'id' => 1, // Asignamos el ID de manera explícita
            'nombre' => 'SuperAdministrador',
            'descripcion' => 'Todos los permisos',
            'padre' => null, // Esto es opcional, si no es un subrol
        ]);

        DB::table('rols')->insert([
            'id' => 2, // Asignamos el ID de manera explícita
            'nombre' => 'Normal',
            'descripcion' => 'navegar',
            'padre' => 1, // Relacionado con el rol "SuperAdministrador"
        ]);

        DB::table('rols')->insert([
            'id' => 3, // Asignamos el ID de manera explícita
            'nombre' => 'Operador',
            'descripcion' => 'Restringido',
            'padre' => 2, // Relacionado con el rol "Normal"
        ]);
    }
}


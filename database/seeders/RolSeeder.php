<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nombre' => 'admin',          'descripcion' => 'Administrador del sistema', 'estado' => true],
            ['nombre' => 'doctor',         'descripcion' => 'Médico del consultorio',    'estado' => true],
            ['nombre' => 'recepcionista',  'descripcion' => 'Recepcionista',             'estado' => true],
            ['nombre' => 'paciente',       'descripcion' => 'Paciente registrado',       'estado' => true],
        ]);
    }
}

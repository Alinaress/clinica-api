<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mnt_paciente')->insert([
            'nombre'            => 'Juan',
            'apellido'          => 'Pérez',
            'dui'               => '12345678-9',
            'id_genero'         => 1,
            'id_grupo_sanguineo' => 1,
            'fecha_nacimiento'  => '1990-01-15',
            'alergias'          => 'Ninguna',
            'estado'            => true,
            'id_usuario'        => 1,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);
    }
}
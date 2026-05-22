<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    public function run(): void
    {
        $especialidades = [
            ['nombre' => 'Medicina General', 'estado' => true],
            ['nombre' => 'Pediatría',        'estado' => true],
            ['nombre' => 'Cardiología',      'estado' => true],
        ];

        foreach ($especialidades as $especialidad) {
            DB::table('ctl_especialidad')->updateOrInsert(
                ['nombre' => $especialidad['nombre']], // Condición para buscar si ya existe
                [
                    'estado'     => $especialidad['estado'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ctl_genero')->insertOrIgnore([
            ['nombre' => 'Masculino', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Femenino',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('ctl_grupo_sanguineo')->insertOrIgnore([
            ['nombre' => 'A+', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'A-', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'B+', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'O+', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'O-', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('ctl_estado_cita')->insertOrIgnore([
            ['nombre' => 'Pendiente',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Confirmada', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'En curso',   'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Completada', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cancelada',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ← especialidades agregadas
        DB::table('ctl_especialidad')->insertOrIgnore([
            ['nombre' => 'Medicina General', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pediatría',        'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cardiología',      'estado' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

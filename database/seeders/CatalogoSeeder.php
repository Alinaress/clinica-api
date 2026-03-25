<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ctl_genero')->insert([
            ['nombre' => 'Masculino', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Femenino',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('ctl_grupo_sanguineo')->insert([
            ['nombre' => 'A+',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'A-',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'B+',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'O+',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'O-',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('ctl_estado_cita')->insert([
    ['nombre' => 'Pendiente',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
    ['nombre' => 'Confirmada', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
    ['nombre' => 'En curso',   'estado' => true, 'created_at' => now(), 'updated_at' => now()],
    ['nombre' => 'Completada', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
    ['nombre' => 'Cancelada',  'estado' => true, 'created_at' => now(), 'updated_at' => now()],
]);
    }
}
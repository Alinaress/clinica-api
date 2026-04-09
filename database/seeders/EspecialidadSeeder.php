<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ctl_especialidad')->insert([
            ['nombre' => 'Medicina General', 'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Pediatría',        'estado' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cardiología',      'estado' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
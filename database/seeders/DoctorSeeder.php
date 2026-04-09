<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MntDoctor;


class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        MntDoctor::updateOrCreate(
            ['num_registro' => 'MED-001'],
            [
                'nombre'          => 'Carlos',
                'apellido'        => 'Martínez',
                'id_especialidad' => 1,
                'foto'            => null,
                'estado'          => true,
                'id_usuario'      => 1,
            ]
        );
    }
}

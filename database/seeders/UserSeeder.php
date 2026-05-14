<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
=======
use Illuminate\Support\Facades\Hash;
use App\Models\User;
>>>>>>> 8bcfe1100982fd23d86401d66508f10b9ce21b45

class UserSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        DB::table('users')->insert([
            'nickname'   => 'admin',
            'email'      => 'admin@clinica.com',
            'password'   => Hash::make('password123'),
            'id_rol'     => 1, // admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
=======
        User::updateOrCreate(
            ['email' => 'admin@clinica.com'],
            [
                'nickname' => 'admin',
                'password' => Hash::make('password123'),
                'id_rol'   => 1,
            ]
        );
>>>>>>> 8bcfe1100982fd23d86401d66508f10b9ce21b45
    }
}

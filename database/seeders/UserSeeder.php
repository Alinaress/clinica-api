<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@clinica.com'],
            [
                'nickname' => 'admin',
                'password' => Hash::make('password123'),
                'id_rol' => 1,
            ]
        );
    }
}

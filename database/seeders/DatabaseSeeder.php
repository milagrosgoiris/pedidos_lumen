<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Role, User};
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $admin = Role::firstOrCreate(['nombre' => 'admin']);
        Role::firstOrCreate(['nombre' => 'gerente']);
        Role::firstOrCreate(['nombre' => 'empleado']);

        // Crear usuario admin
        User::firstOrCreate(
            ['email' => 'admin@lumen.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role_id' => $admin->id,
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@essalud.pe'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'), // cambia la password luego
            ]
        );
    }
}
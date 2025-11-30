<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador principal
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => env('SUPER_ADMIN_NAME', 'Bryan Arteaga'),
                'email' => env('SUPER_ADMIN_EMAIL', 'barteagame@gmail.com'),
                'password' => Hash::make(env('SUPER_ADMIN_PASSWORD', 'Bryan1901_')),
                'is_admin' => 1,
            ]
        );

        // 20 usuarios mezclados (administradores y usuarios regulares)
        $usuarios = [
            [
                'name' => 'Pedro Ramírez',
                'email' => 'pedro.ramirez@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Dra. María García',
                'email' => 'maria.garcia@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Carmen López',
                'email' => 'carmen.lopez@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Enf. Ana Torres',
                'email' => 'ana.torres@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
        ];

        // Crear todos los usuarios
        foreach ($usuarios as $usuario) {
            User::updateOrCreate(
                ['email' => $usuario['email']],
                $usuario
            );
        }
    }
}
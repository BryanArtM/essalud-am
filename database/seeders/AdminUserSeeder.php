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
            ['email' => env('ADMIN_EMAIL', 'admin@gmail.com')],
            [
                'name' => env('ADMIN_NAME', 'Administrador'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
                'is_admin' => 1,
            ]
        );

        // 20 usuarios mezclados (administradores y usuarios regulares)
        $usuarios = [
            [
                'name' => 'Dr. Carlos Mendoza',
                'email' => 'carlos.mendoza@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Pedro Ramírez',
                'email' => 'pedro.ramirez@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
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
            [
                'name' => 'Luis Fernández',
                'email' => 'luis.fernandez@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Dr. Roberto Silva',
                'email' => 'roberto.silva@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Rosa Martínez',
                'email' => 'rosa.martinez@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'José Herrera',
                'email' => 'jose.herrera@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Dra. Elena Vargas',
                'email' => 'elena.vargas@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Miguel Ángel Castro',
                'email' => 'miguel.castro@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Enf. Patricia Ruiz',
                'email' => 'patricia.ruiz@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Diana Flores',
                'email' => 'diana.flores@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Antonio Morales',
                'email' => 'antonio.morales@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Dr. Andrés Jiménez',
                'email' => 'andres.jimenez@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Lucía Romero',
                'email' => 'lucia.romero@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Enf. Sandra Paredes',
                'email' => 'sandra.paredes@gmail.com',
                'password' => Hash::make('admin123'),
                'is_admin' => 1,
            ],
            [
                'name' => 'Fernando Guerrero',
                'email' => 'fernando.guerrero@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Gabriela Ortiz',
                'email' => 'gabriela.ortiz@gmail.com',
                'password' => Hash::make('user123'),
                'is_admin' => 0,
            ],
            [
                'name' => 'Dr. Raúl Delgado',
                'email' => 'raul.delgado@gmail.com',
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
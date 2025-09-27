<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActividadesEducativasSeeder extends Seeder
{
    public function run()
    {
        $actividades = [
            // Actividades para María Carmen González (adulto_mayor_id = 1)
            [
                'adulto_mayor_id' => 1,
                'fecha' => '2024-01-30',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-01-15 10:00:00',
                'updated_at' => '2024-01-15 10:00:00',
            ],
            [
                'adulto_mayor_id' => 1,
                'fecha' => '2024-02-15',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-01-20 10:00:00',
                'updated_at' => '2024-01-20 10:00:00',
            ],
            [
                'adulto_mayor_id' => 1,
                'fecha' => '2024-03-01',
                'numero_sesion' => 'SE-003',
                'created_at' => '2024-01-25 10:00:00',
                'updated_at' => '2024-01-25 10:00:00',
            ],
            // Actividades para José Antonio Martínez (adulto_mayor_id = 2)
            [
                'adulto_mayor_id' => 2,
                'fecha' => '2024-02-20',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-02-10 09:15:00',
                'updated_at' => '2024-02-10 09:15:00',
            ],
            [
                'adulto_mayor_id' => 2,
                'fecha' => '2024-03-05',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-03-10 11:45:00',
                'updated_at' => '2024-03-10 11:45:00',
            ],
            [
                'adulto_mayor_id' => 2,
                'fecha' => '2024-03-09',
                'numero_sesion' => 'SE-003',
                'created_at' => '2024-03-13 11:45:00',
                'updated_at' => '2024-03-13 11:45:00',
            ],
            // Actividades para Carmen Rosa López (adulto_mayor_id = 3)
            [
                'adulto_mayor_id' => 3,
                'fecha' => '2024-03-10',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-03-04 08:20:00',
                'updated_at' => '2024-03-04 08:20:00',
            ],
            [
                'adulto_mayor_id' => 3,
                'fecha' => '2024-03-25',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-03-05 08:20:00',
                'updated_at' => '2024-03-05 08:20:00',
            ],
            // Actividades para Pedro Manuel Rodríguez (adulto_mayor_id = 4)
            [
                'adulto_mayor_id' => 4,
                'fecha' => '2024-03-20',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-03-15 15:10:00',
                'updated_at' => '2024-03-15 15:10:00',
            ],
            [
                'adulto_mayor_id' => 4,
                'fecha' => '2024-04-10',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-03-16 15:10:00',
                'updated_at' => '2024-03-16 15:10:00',
            ],
            // Actividades para Ana Lucía Vásquez (adulto_mayor_id = 5)
            [
                'adulto_mayor_id' => 5,
                'fecha' => '2024-03-25',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-03-25 13:30:00',
                'updated_at' => '2024-03-25 13:30:00',
            ],
            // Actividades para Roberto Carlos Morales (adulto_mayor_id = 6)
            [
                'adulto_mayor_id' => 6,
                'fecha' => '2024-04-02',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-01 09:00:00',
                'updated_at' => '2024-04-01 09:00:00',
            ],
            [
                'adulto_mayor_id' => 6,
                'fecha' => '2024-04-16',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-04-15 14:20:00',
                'updated_at' => '2024-04-15 14:20:00',
            ],
            [
                'adulto_mayor_id' => 6,
                'fecha' => '2024-04-30',
                'numero_sesion' => 'SE-003',
                'created_at' => '2024-04-16 14:20:00',
                'updated_at' => '2024-04-16 14:20:00',
            ],
            // Actividades para Elena Rosa Flores (adulto_mayor_id = 7)
            [
                'adulto_mayor_id' => 7,
                'fecha' => '2024-04-08',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-05 11:30:00',
                'updated_at' => '2024-04-05 11:30:00',
            ],
            [
                'adulto_mayor_id' => 7,
                'fecha' => '2024-04-22',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-04-06 11:30:00',
                'updated_at' => '2024-04-06 11:30:00',
            ],
            // Actividades para Miguel Ángel Chávez (adulto_mayor_id = 8)
            [
                'adulto_mayor_id' => 8,
                'fecha' => '2024-04-12',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-10 16:45:00',
                'updated_at' => '2024-04-10 16:45:00',
            ],
            // Actividades para Luz Marina Sandoval (adulto_mayor_id = 9)
            [
                'adulto_mayor_id' => 9,
                'fecha' => '2024-04-14',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-12 08:30:00',
                'updated_at' => '2024-04-12 08:30:00',
            ],
            [
                'adulto_mayor_id' => 9,
                'fecha' => '2024-04-28',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-04-26 12:15:00',
                'updated_at' => '2024-04-26 12:15:00',
            ],
            // Actividades para Fernando Luis Reyes (adulto_mayor_id = 10)
            [
                'adulto_mayor_id' => 10,
                'fecha' => '2024-04-18',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-15 15:40:00',
                'updated_at' => '2024-04-15 15:40:00',
            ],
            // Actividades para Teresa Elvira Huamán (adulto_mayor_id = 11)
            [
                'adulto_mayor_id' => 11,
                'fecha' => '2024-04-20',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-18 09:50:00',
                'updated_at' => '2024-04-18 09:50:00',
            ],
            [
                'adulto_mayor_id' => 11,
                'fecha' => '2024-05-04',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-05-02 13:25:00',
                'updated_at' => '2024-05-02 13:25:00',
            ],
            [
                'adulto_mayor_id' => 11,
                'fecha' => '2024-05-18',
                'numero_sesion' => 'SE-003',
                'created_at' => '2024-05-05 13:25:00',
                'updated_at' => '2024-05-05 13:25:00',
            ],
            // Actividades para Alberto Jesús Campos (adulto_mayor_id = 12)
            [
                'adulto_mayor_id' => 12,
                'fecha' => '2024-04-22',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-20 10:40:00',
                'updated_at' => '2024-04-20 10:40:00',
            ],
            // Actividades para Rosa María Aguilar (adulto_mayor_id = 13)
            [
                'adulto_mayor_id' => 13,
                'fecha' => '2024-04-24',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-22 14:55:00',
                'updated_at' => '2024-04-22 14:55:00',
            ],
            [
                'adulto_mayor_id' => 13,
                'fecha' => '2024-05-08',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-04-26 14:55:00',
                'updated_at' => '2024-04-26 14:55:00',
            ],
            // Actividades para Juan Carlos Córdova (adulto_mayor_id = 14)
            [
                'adulto_mayor_id' => 14,
                'fecha' => '2024-04-27',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-25 11:10:00',
                'updated_at' => '2024-04-25 11:10:00',
            ],
            [
                'adulto_mayor_id' => 14,
                'fecha' => '2024-05-11',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-05-09 16:20:00',
                'updated_at' => '2024-05-09 16:20:00',
            ],
            [
                'adulto_mayor_id' => 14,
                'fecha' => '2024-05-25',
                'numero_sesion' => 'SE-003',
                'created_at' => '2024-05-14 16:20:00',
                'updated_at' => '2024-05-14 16:20:00',
            ],
            // Actividades para Gladys Noemí Medina (adulto_mayor_id = 15)
            [
                'adulto_mayor_id' => 15,
                'fecha' => '2024-04-30',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-04-28 08:45:00',
                'updated_at' => '2024-04-28 08:45:00',
            ],
            // Actividades para Víctor Hugo Castillo (adulto_mayor_id = 16)
            [
                'adulto_mayor_id' => 16,
                'fecha' => '2024-05-04',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-05-02 12:00:00',
                'updated_at' => '2024-05-02 12:00:00',
            ],
            [
                'adulto_mayor_id' => 16,
                'fecha' => '2024-05-18',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-05-06 12:00:00',
                'updated_at' => '2024-05-06 12:00:00',
            ],
            // Actividades para Margarita Isabel Villanueva (adulto_mayor_id = 17)
            [
                'adulto_mayor_id' => 17,
                'fecha' => '2024-05-07',
                'numero_sesion' => 'SE-001',
                'created_at' => '2024-05-05 09:35:00',
                'updated_at' => '2024-05-05 09:35:00',
            ],
            [
                'adulto_mayor_id' => 17,
                'fecha' => '2024-05-21',
                'numero_sesion' => 'SE-002',
                'created_at' => '2024-05-19 15:15:00',
                'updated_at' => '2024-05-19 15:15:00',
            ],
            // Actividades para Ricardo Manuel Espinoza (adulto_mayor_id = 18)
            [
                'adulto_mayor_id' => 18,
                'fecha' => '2025-05-10',
                'numero_sesion' => 'SE-001',
                'created_at' => '2025-05-08 13:50:00',
                'updated_at' => '2025-05-08 13:50:00',
            ],
            // Actividades para Silvia Patricia Hidalgo (adulto_mayor_id = 19)
            [
                'adulto_mayor_id' => 19,
                'fecha' => '2025-08-12',
                'numero_sesion' => 'SE-001',
                'created_at' => '2025-08-10 10:25:00',
                'updated_at' => '2025-08-10 10:25:00',
            ],
            [
                'adulto_mayor_id' => 19,
                'fecha' => '2025-08-26',
                'numero_sesion' => 'SE-002',
                'created_at' => '2025-08-24 14:40:00',
                'updated_at' => '2025-08-24 14:40:00',
            ],
            // Actividades para Oswaldo Enrique Ramos (adulto_mayor_id = 20)
            [
                'adulto_mayor_id' => 20,
                'fecha' => '2025-09-14',
                'numero_sesion' => 'SE-001',
                'created_at' => '2025-09-12 11:05:00',
                'updated_at' => '2025-09-12 11:05:00',
            ]

        ];

        DB::table('actividades_educativas')->insert($actividades);
    }
}
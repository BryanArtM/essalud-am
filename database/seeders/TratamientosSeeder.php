<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TratamientosSeeder extends Seeder
{
    public function run()
    {
        $tratamientos = [
            // Tratamientos para María Carmen González (adulto_mayor_id = 1)
            [
                'adulto_mayor_id' => 1,
                'medicacion' => 'Amlodipino',
                'dosis' => '5 mg',
                'created_at' => '2024-01-15 10:00:00',
                'updated_at' => '2024-01-15 10:00:00',
            ],
            [
                'adulto_mayor_id' => 1,
                'medicacion' => 'Atorvastatina',
                'dosis' => '20 mg',
                'created_at' => '2024-01-16 10:00:00',
                'updated_at' => '2024-01-16 10:00:00',
            ],
            [
                'adulto_mayor_id' => 1,
                'medicacion' => 'Diclofenaco',
                'dosis' => '50 mg',
                'created_at' => '2024-01-17 10:00:00',
                'updated_at' => '2024-01-17 10:00:00',
            ],
            // Tratamientos para José Antonio Martínez (adulto_mayor_id = 2)
            [
                'adulto_mayor_id' => 2,
                'medicacion' => 'Metformina',
                'dosis' => '850 mg',
                'created_at' => '2024-02-10 09:15:00',
                'updated_at' => '2024-02-10 09:15:00',
            ],
            [
                'adulto_mayor_id' => 2,
                'medicacion' => 'Enalapril',
                'dosis' => '10 mg',
                'created_at' => '2024-02-11 09:15:00',
                'updated_at' => '2024-02-11 09:15:00',
            ],
            [
                'adulto_mayor_id' => 2,
                'medicacion' => 'Insulina NPH',
                'dosis' => '20 mg',
                'created_at' => '2024-02-12 09:15:00',
                'updated_at' => '2024-02-12 09:15:00',
            ],
            [
                'adulto_mayor_id' => 2,
                'medicacion' => 'Furosemida',
                'dosis' => '40 mg',
                'created_at' => '2024-02-13 09:15:00',
                'updated_at' => '2024-02-13 09:15:00',
            ],
            // Tratamientos para Carmen Rosa López (adulto_mayor_id = 3)
            [
                'adulto_mayor_id' => 3,
                'medicacion' => 'Salbutamol',
                'dosis' => '2 mg',
                'created_at' => '2024-03-04 08:20:00',
                'updated_at' => '2024-03-04 08:20:00',
            ],
            [
                'adulto_mayor_id' => 3,
                'medicacion' => 'Ibuprofeno',
                'dosis' => '400 mg',
                'created_at' => '2024-03-05 08:20:00',
                'updated_at' => '2024-03-05 08:20:00',
            ],
            // Tratamientos para Pedro Manuel Rodríguez (adulto_mayor_id = 4)
            [
                'adulto_mayor_id' => 4,
                'medicacion' => 'Losartán',
                'dosis' => '50 mg',
                'created_at' => '2024-03-15 15:10:00',
                'updated_at' => '2024-03-15 15:10:00',
            ],
            [
                'adulto_mayor_id' => 4,
                'medicacion' => 'Levotiroxina',
                'dosis' => '75 mg',
                'created_at' => '2024-03-16 15:10:00',
                'updated_at' => '2024-03-16 15:10:00',
            ],
            [
                'adulto_mayor_id' => 4,
                'medicacion' => 'Budesonida',
                'dosis' => '160 mg',
                'created_at' => '2024-03-17 15:10:00',
                'updated_at' => '2024-03-17 15:10:00',
            ],
            // Tratamientos para Ana Lucía Vásquez (adulto_mayor_id = 5)
            [
                'adulto_mayor_id' => 5,
                'medicacion' => 'Paracetamol',
                'dosis' => ' 500 mg',
                'created_at' => '2024-03-25 13:30:00',
                'updated_at' => '2024-03-25 13:30:00',
            ],
            [
                'adulto_mayor_id' => 5,
                'medicacion' => 'Calcio + Vitamina D',
                'dosis' => '600 mg',
                'created_at' => '2024-03-26 13:30:00',
                'updated_at' => '2024-03-26 13:30:00',
            ],
            // Tratamientos para Roberto Carlos Morales (adulto_mayor_id = 6)
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Metformina',
                'dosis' => '1000 mg',
                'created_at' => '2024-04-01 09:00:00',
                'updated_at' => '2024-04-01 09:00:00',
            ],
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Enalapril',
                'dosis' => '20 mg',
                'created_at' => '2024-04-02 09:00:00',
                'updated_at' => '2024-04-02 09:00:00',
            ],
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Insulina glargina',
                'dosis' => '25 mg',
                'created_at' => '2024-04-03 09:00:00',
                'updated_at' => '2024-04-03 09:00:00',
            ],
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Furosemida',
                'dosis' => '20 mg',
                'created_at' => '2024-04-04 09:00:00',
                'updated_at' => '2024-04-04 09:00:00',
            ],
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Warfarina',
                'dosis' => '5 mg',
                'created_at' => '2024-04-05 09:00:00',
                'updated_at' => '2024-04-05 09:00:00',
            ],
            // Tratamientos para Elena Rosa Flores (adulto_mayor_id = 7)
            [
                'adulto_mayor_id' => 7,
                'medicacion' => 'Amlodipino',
                'dosis' => '10 mg',
                'created_at' => '2024-04-05 11:30:00',
                'updated_at' => '2024-04-05 11:30:00',
            ],
            [
                'adulto_mayor_id' => 7,
                'medicacion' => 'Atorvastatina',
                'dosis' => '40 mg',
                'created_at' => '2024-04-06 11:30:00',
                'updated_at' => '2024-04-06 11:30:00',
            ],
            [
                'adulto_mayor_id' => 7,
                'medicacion' => 'Levotiroxina',
                'dosis' => '100 mg',
                'created_at' => '2024-04-07 11:30:00',
                'updated_at' => '2024-04-07 11:30:00',
            ],
            [
                'adulto_mayor_id' => 7,
                'medicacion' => 'Metformina',
                'dosis' => '500 mg',
                'created_at' => '2024-04-08 11:30:00',
                'updated_at' => '2024-04-08 11:30:00',
            ],
            // Tratamientos para Miguel Ángel Chávez (adulto_mayor_id = 8)
            [
                'adulto_mayor_id' => 8,
                'medicacion' => 'Ibuprofeno',
                'dosis' => '600 mg',
                'created_at' => '2024-04-10 16:45:00',
                'updated_at' => '2024-04-10 16:45:00',
            ],
            [
                'adulto_mayor_id' => 8,
                'medicacion' => 'Glucosamina',
                'dosis' => '1500 mg',
                'created_at' => '2024-04-11 16:45:00',
                'updated_at' => '2024-04-11 16:45:00',
            ],
            // Tratamientos para Luz Marina Sandoval (adulto_mayor_id = 9)
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Metformina',
                'dosis' => '850 mg',
                'created_at' => '2024-04-12 08:30:00',
                'updated_at' => '2024-04-12 08:30:00',
            ],
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Losartán',
                'dosis' => '100 mg',
                'created_at' => '2024-04-13 08:30:00',
                'updated_at' => '2024-04-13 08:30:00',
            ],
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Atorvastatina',
                'dosis' => '20 mg',
                'created_at' => '2024-04-14 08:30:00',
                'updated_at' => '2024-04-14 08:30:00',
            ],
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Sertralina',
                'dosis' => '50 mg',
                'created_at' => '2024-04-15 08:30:00',
                'updated_at' => '2024-04-15 08:30:00',
            ],
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Alendronato',
                'dosis' => '70 mg',
                'created_at' => '2024-04-16 08:30:00',
                'updated_at' => '2024-04-16 08:30:00',
            ],
            // Tratamientos para Fernando Luis Reyes (adulto_mayor_id = 10)
            [
                'adulto_mayor_id' => 10,
                'medicacion' => 'Amlodipino',
                'dosis' => '5 mg',
                'created_at' => '2024-04-15 15:40:00',
                'updated_at' => '2024-04-15 15:40:00',
            ],
            [
                'adulto_mayor_id' => 10,
                'medicacion' => 'Simvastatina',
                'dosis' => '20 mg',
                'created_at' => '2024-04-16 15:40:00',
                'updated_at' => '2024-04-16 15:40:00',
            ],
            [
                'adulto_mayor_id' => 10,
                'medicacion' => 'Propranolol',
                'dosis' => '40 mg',
                'created_at' => '2024-04-17 15:40:00',
                'updated_at' => '2024-04-17 15:40:00',
            ],
            // Tratamientos para Teresa Elvira Huamán (adulto_mayor_id = 11)
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Metformina',
                'dosis' => '1000 mg',
                'created_at' => '2024-04-18 09:50:00',
                'updated_at' => '2024-04-18 09:50:00',
            ],
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Enalapril',
                'dosis' => '20 mg',
                'created_at' => '2024-04-19 09:50:00',
                'updated_at' => '2024-04-19 09:50:00',
            ],
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Insulina NPH',
                'dosis' => '30 mg',
                'created_at' => '2024-04-20 09:50:00',
                'updated_at' => '2024-04-20 09:50:00',
            ],
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Furosemida',
                'dosis' => '40 mg',
                'created_at' => '2024-04-21 09:50:00',
                'updated_at' => '2024-04-21 09:50:00',
            ],
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Digoxina',
                'dosis' => '0.25 mg',
                'created_at' => '2024-04-22 09:50:00',
                'updated_at' => '2024-04-22 09:50:00',
            ],
            // Tratamientos para Alberto Jesús Campos (adulto_mayor_id = 12)
            [
                'adulto_mayor_id' => 12,
                'medicacion' => 'Losartán',
                'dosis' => '50 mg',
                'created_at' => '2024-04-20 10:40:00',
                'updated_at' => '2024-04-20 10:40:00',
            ],
            [
                'adulto_mayor_id' => 12,
                'medicacion' => 'Atorvastatina',
                'dosis' => '20 mg',
                'created_at' => '2024-04-21 10:40:00',
                'updated_at' => '2024-04-21 10:40:00',
            ],
            [
                'adulto_mayor_id' => 12,
                'medicacion' => 'Tiotropio',
                'dosis' => '18 mcg',
                'created_at' => '2024-04-22 10:40:00',
                'updated_at' => '2024-04-22 10:40:00',
            ],
            [
                'adulto_mayor_id' => 12,
                'medicacion' => 'Diclofenaco',
                'dosis' => '75 mg',
                'created_at' => '2024-04-23 10:40:00',
                'updated_at' => '2024-04-23 10:40:00',
            ],
            // Tratamientos para Rosa María Aguilar (adulto_mayor_id = 13)
            [
                'adulto_mayor_id' => 13,
                'medicacion' => 'Amlodipino',
                'dosis' => '5 mg',
                'created_at' => '2024-04-22 14:55:00',
                'updated_at' => '2024-04-22 14:55:00',
            ],
            [
                'adulto_mayor_id' => 13,
                'medicacion' => 'Salbutamol',
                'dosis' => '2 mg',
                'created_at' => '2024-04-23 14:55:00',
                'updated_at' => '2024-04-23 14:55:00',
            ],
            [
                'adulto_mayor_id' => 13,
                'medicacion' => 'Paracetamol',
                'dosis' => '500 mg',
                'created_at' => '2024-04-24 14:55:00',
                'updated_at' => '2024-04-24 14:55:00',
            ],
            // Tratamientos para Juan Carlos Córdova (adulto_mayor_id = 14)
            [
                'adulto_mayor_id' => 14,
                'medicacion' => 'Metformina',
                'dosis' =>  '500 mg',
                'created_at' => '2024-04-25 11:10:00',
                'updated_at' => '2024-04-25 11:10:00',
            ],
            [
                'adulto_mayor_id' => 14,
                'medicacion' => 'Enalapril',
                'dosis' => '20 mg',
                'created_at' => '2024-04-26 11:10:00',
                'updated_at' => '2024-04-26 11:10:00',
            ],
            [
                'adulto_mayor_id' => 14,
                'medicacion' => 'Insulina glargina',
                'dosis' => '35 mg',
                'created_at' => '2024-04-27 11:10:00',
                'updated_at' => '2024-04-27 11:10:00',
            ],
            [
                'adulto_mayor_id' => 14,
                'medicacion' => 'Pregabalina',
                'dosis' => '75 mg',
                'created_at' => '2024-04-28 11:10:00',
                'updated_at' => '2024-04-28 11:10:00',
            ],
            // Tratamientos para Gladys Noemí Medina (adulto_mayor_id = 15)
            [
                'adulto_mayor_id' => 15,
                'medicacion' => 'Calcio + Vitamina D',
                'dosis' => '600 mg',
                'created_at' => '2024-05-09 16:20:00',
                'updated_at' => '2024-05-09 16:20:00',
            ],
            [
                'adulto_mayor_id' => 15,
                'medicacion' => 'Complejo B',
                'dosis' => '1',
                'created_at' => '2024-05-10 16:20:00',
                'updated_at' => '2024-05-10 16:20:00',
            ],
            // Tratamientos para Víctor Hugo Castillo (adulto_mayor_id = 16)
            [
                'adulto_mayor_id' => 16,
                'medicacion' => 'Amlodipino',
                'dosis' => '10 mg',
                'created_at' => '2024-05-03 16:20:00',
                'updated_at' => '2024-05-03 16:20:00',
            ],
            [
                'adulto_mayor_id' => 16,
                'medicacion' => 'Atorvastatina',
                'dosis' => '40 mg',
                'created_at' => '2024-05-04 16:20:00',
                'updated_at' => '2024-05-04 16:20:00',
            ],
            [
                'adulto_mayor_id' => 16,
                'medicacion' => 'Timolol',
                'dosis' => '0.5 mg',
                'created_at' => '2024-05-05 16:20:00',
                'updated_at' => '2024-05-05 16:20:00',
            ],
            [
                'adulto_mayor_id' => 16,
                'medicacion' => 'Ibuprofeno',
                'dosis' => '400 mg',
                'created_at' => '2024-05-06 16:20:00',
                'updated_at' => '2024-05-06 16:20:00',
            ],
            // Tratamientos para Margarita Isabel Villanueva (adulto_mayor_id = 17)
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Metformina',
                'dosis' => '850 mg',
                'created_at' => '2024-05-05 16:20:00',
                'updated_at' => '2024-05-05 16:20:00',
            ],
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Losartán',
                'dosis' => '100 mg',
                'created_at' => '2024-05-05 16:20:00',
                'updated_at' => '2024-05-05 16:20:00',
            ],
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Atorvastatina',
                'dosis' => '40 mg',
                'created_at' => '2024-05-05 16:20:00',
                'updated_at' => '2024-05-05 16:20:00',
            ],
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Donepezilo',
                'dosis' => '10 mg',
                'created_at' => '2024-05-05 16:20:00',
                'updated_at' => '2024-05-05 16:20:00',
            ],
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Diclofenaco',
                'dosis' => '50 mg',
                'created_at' => '2024-05-05 16:20:00',
                'updated_at' => '2024-05-05 16:20:00',
            ],
            // Tratamientos para Ricardo Manuel Espinoza (adulto_mayor_id = 18)
            [
                'adulto_mayor_id' => 18,
                'medicacion' => 'Ibuprofeno',
                'dosis' => '600 mg',
                'created_at' => '2025-05-03 16:20:00',
                'updated_at' => '2025-05-03 16:20:00',
            ],
            [
                'adulto_mayor_id' => 18,
                'medicacion' => 'Glucosamina',
                'dosis' => '1500 mg',
                'created_at' => '2025-05-04 16:20:00',
                'updated_at' => '2025-05-04 16:20:00',
            ],
            [
                'adulto_mayor_id' => 18,
                'medicacion' => 'Omega 3',
                'dosis' => '1000 mg',
                'created_at' => '2025-05-05 16:20:00',
                'updated_at' => '2025-05-05 16:20:00',
            ],
            // Tratamientos para Silvia Patricia Hidalgo (adulto_mayor_id = 19)
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Metformina',
                'dosis' => '850 mg',
                'created_at' => '2025-08-10 10:25:00',
                'updated_at' => '2025-08-10 10:25:00',
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Enalapril',
                'dosis' => '10 mg',
                'created_at' => '2025-08-10 10:25:00',
                'updated_at' => '2025-08-10 10:25:00',
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Atorvastatina',
                'dosis' => '20 mg',
                'created_at' => '2025-08-10 10:25:00',
                'updated_at' => '2025-08-10 10:25:00',
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Duloxetina',
                'dosis' => '60 mg',
                'created_at' => '2025-08-10 10:25:00',
                'updated_at' => '2025-08-10 10:25:00',
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Pregabalina',
                'dosis' => '150 mg',
                'created_at' => '2025-08-10 10:25:00',
                'updated_at' => '2025-08-10 10:25:00',
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Diclofenaco',
                'dosis' => '50 mg',
                'created_at' => '2025-08-10 10:25:00',
                'updated_at' => '2025-08-10 10:25:00',
            ],
            // Tratamientos para Oswaldo Enrique Ramos (adulto_mayor_id = 20)
            [
                'adulto_mayor_id' => 20,
                'medicacion' => 'Enalapril',
                'dosis' => '10 mg',
                'created_at' => '2025-09-12 11:05:00',
                'updated_at' => '2025-09-12 11:05:00',
            ],
            [
                'adulto_mayor_id' => 20,
                'medicacion' => 'Aspirina',
                'dosis' => '100 mg',
                'created_at' => '2025-09-13 11:05:00',
                'updated_at' => '2025-09-13 11:05:00',
            ],
        ];

        DB::table('tratamientos')->insert($tratamientos);
    
}   
}
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
                'dosis' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 1,
                'medicacion' => 'Atorvastatina',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 1,
                'medicacion' => 'Diclofenaco',
                'dosis' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para José Antonio Martínez (adulto_mayor_id = 2)
            [
                'adulto_mayor_id' => 2,
                'medicacion' => 'Metformina',
                'dosis' => 850,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 2,
                'medicacion' => 'Enalapril',
                'dosis' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 2,
                'medicacion' => 'Insulina NPH',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 2,
                'medicacion' => 'Furosemida',
                'dosis' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Carmen Rosa López (adulto_mayor_id = 3)
            [
                'adulto_mayor_id' => 3,
                'medicacion' => 'Salbutamol',
                'dosis' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 3,
                'medicacion' => 'Ibuprofeno',
                'dosis' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Pedro Manuel Rodríguez (adulto_mayor_id = 4)
            [
                'adulto_mayor_id' => 4,
                'medicacion' => 'Losartán',
                'dosis' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 4,
                'medicacion' => 'Levotiroxina',
                'dosis' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 4,
                'medicacion' => 'Budesonida',
                'dosis' => 160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Ana Lucía Vásquez (adulto_mayor_id = 5)
            [
                'adulto_mayor_id' => 5,
                'medicacion' => 'Paracetamol',
                'dosis' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 5,
                'medicacion' => 'Calcio + Vitamina D',
                'dosis' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Roberto Carlos Morales (adulto_mayor_id = 6)
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Metformina',
                'dosis' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Enalapril',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Insulina glargina',
                'dosis' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Furosemida',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 6,
                'medicacion' => 'Warfarina',
                'dosis' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Elena Rosa Flores (adulto_mayor_id = 7)
            [
                'adulto_mayor_id' => 7,
                'medicacion' => 'Amlodipino',
                'dosis' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 7,
                'medicacion' => 'Atorvastatina',
                'dosis' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 7,
                'medicacion' => 'Levotiroxina',
                'dosis' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 7,
                'medicacion' => 'Metformina',
                'dosis' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Miguel Ángel Chávez (adulto_mayor_id = 8)
            [
                'adulto_mayor_id' => 8,
                'medicacion' => 'Ibuprofeno',
                'dosis' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 8,
                'medicacion' => 'Glucosamina',
                'dosis' => 1500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Luz Marina Sandoval (adulto_mayor_id = 9)
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Metformina',
                'dosis' => 850,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Losartán',
                'dosis' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Atorvastatina',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Sertralina',
                'dosis' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 9,
                'medicacion' => 'Alendronato',
                'dosis' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Fernando Luis Reyes (adulto_mayor_id = 10)
            [
                'adulto_mayor_id' => 10,
                'medicacion' => 'Amlodipino',
                'dosis' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 10,
                'medicacion' => 'Simvastatina',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 10,
                'medicacion' => 'Propranolol',
                'dosis' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Teresa Elvira Huamán (adulto_mayor_id = 11)
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Metformina',
                'dosis' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Enalapril',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Insulina NPH',
                'dosis' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Furosemida',
                'dosis' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 11,
                'medicacion' => 'Digoxina',
                'dosis' => 0.25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Alberto Jesús Campos (adulto_mayor_id = 12)
            [
                'adulto_mayor_id' => 12,
                'medicacion' => 'Losartán',
                'dosis' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 12,
                'medicacion' => 'Atorvastatina',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 12,
                'medicacion' => 'Tiotropio',
                'dosis' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 12,
                'medicacion' => 'Diclofenaco',
                'dosis' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Rosa María Aguilar (adulto_mayor_id = 13)
            [
                'adulto_mayor_id' => 13,
                'medicacion' => 'Amlodipino',
                'dosis' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 13,
                'medicacion' => 'Salbutamol',
                'dosis' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 13,
                'medicacion' => 'Paracetamol',
                'dosis' => 500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Juan Carlos Córdova (adulto_mayor_id = 14)
            [
                'adulto_mayor_id' => 14,
                'medicacion' => 'Metformina',
                'dosis' => 850,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 14,
                'medicacion' => 'Enalapril',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 14,
                'medicacion' => 'Insulina glargina',
                'dosis' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 14,
                'medicacion' => 'Pregabalina',
                'dosis' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Gladys Noemí Medina (adulto_mayor_id = 15)
            [
                'adulto_mayor_id' => 15,
                'medicacion' => 'Calcio + Vitamina D',
                'dosis' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 15,
                'medicacion' => 'Complejo B',
                'dosis' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Víctor Hugo Castillo (adulto_mayor_id = 16)
            [
                'adulto_mayor_id' => 16,
                'medicacion' => 'Amlodipino',
                'dosis' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 16,
                'medicacion' => 'Atorvastatina',
                'dosis' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 16,
                'medicacion' => 'Timolol',
                'dosis' => 0.5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 16,
                'medicacion' => 'Ibuprofeno',
                'dosis' => 400,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Margarita Isabel Villanueva (adulto_mayor_id = 17)
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Metformina',
                'dosis' => 850,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Losartán',
                'dosis' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Atorvastatina',
                'dosis' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Donepezilo',
                'dosis' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 17,
                'medicacion' => 'Diclofenaco',
                'dosis' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Ricardo Manuel Espinoza (adulto_mayor_id = 18)
            [
                'adulto_mayor_id' => 18,
                'medicacion' => 'Ibuprofeno',
                'dosis' => 600,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 18,
                'medicacion' => 'Glucosamina',
                'dosis' => 1500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 18,
                'medicacion' => 'Omega 3',
                'dosis' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Silvia Patricia Hidalgo (adulto_mayor_id = 19)
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Metformina',
                'dosis' => 850,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Enalapril',
                'dosis' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Atorvastatina',
                'dosis' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Duloxetina',
                'dosis' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Pregabalina',
                'dosis' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 19,
                'medicacion' => 'Diclofenaco',
                'dosis' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tratamientos para Oswaldo Enrique Ramos (adulto_mayor_id = 20)
            [
                'adulto_mayor_id' => 20,
                'medicacion' => 'Enalapril',
                'dosis' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'adulto_mayor_id' => 20,
                'medicacion' => 'Aspirina',
                'dosis' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tratamientos')->insert($tratamientos);
    }
}
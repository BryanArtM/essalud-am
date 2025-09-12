<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            AdultosMayoresSeeder::class,
            EnfermedadesSeeder::class,
            RiesgosSeeder::class,
            EvaluacionesSeeder::class,
            CitasSeeder::class,
            TratamientosSeeder::class,
            ValoracionesSeeder::class,
            ActividadesEducativasSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AdultoMayor;
use App\Models\Enfermedad;
use App\Models\Riesgo;
use App\Models\Evaluacion;
use App\Models\Cita;
use App\Models\Tratamiento;
use App\Models\Valoracion;
use App\Models\ActividadEducativa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
        ]);

        // 2. Crear adultos mayores 
        $adultosMayores = AdultoMayor::factory(220)->create();

        echo "{$adultosMayores->count()} Adultos mayores creados\n";

        // 3. Para cada adulto mayor, crear sus registros relacionados
        foreach ($adultosMayores as $adultoMayor) {
            // Enfermedades (siempre crear)
            $this->createEnfermedad($adultoMayor);

            // Riesgos (siempre crear)
            $this->createRiesgo($adultoMayor);

            // Evaluaciones (90% tienen evaluación)
            if (rand(1, 10) <= 9) {
                $numEval = rand(2, 10);  // Entre 2 y 10 evaluaciones
                for ($i = 0; $i < $numEval; $i++) {
                    $this->createEvaluacion($adultoMayor);
                }
            }

            // Valoración (70% tienen valoración)
            if (rand(1, 10) <= 7) {
                $this->createValoracion($adultoMayor);
            }

            // Citas (80% tienen citas)
            if (rand(1, 10) <= 8) {
                $numCitas = rand(1, 10); // Entre 1 y 10 citas
                for ($i = 0; $i < $numCitas; $i++) {
                    $this->createCita($adultoMayor);
                }
            }

            // Tratamientos (70% tienen tratamientos)
            if (rand(1, 10) <= 7) {
                $numTratamientos = rand(2, 8); // Entre 2 y 8 tratamientos
                for ($i = 0; $i < $numTratamientos; $i++) {
                    $this->createTratamiento($adultoMayor);
                }
            }

            // Actividades educativas (90% tienen actividades educativas)
            if (rand(1, 10) <= 9) {
                $numActividades = rand(0, 11); // Entre 0 y 11 actividades
                $this->createActividadesEducativas($adultoMayor, $numActividades);
            }
        }
    }

    private function createEnfermedad(AdultoMayor $adultoMayor): void
    {
        Enfermedad::create([
            'adulto_mayor_id' => $adultoMayor->id,
            'obesidad' => fake()->boolean(20),
            'dislipidemia' => fake()->boolean(35),
            'hipertension_arterial' => fake()->boolean(45),
            'diabetes_mellitus' => fake()->boolean(25),
            'erc' => fake()->boolean(15),
            'osteoartrosis' => fake()->boolean(40),
            'asma' => fake()->boolean(10),
            'epoc' => fake()->boolean(12),
            'itg' => fake()->boolean(8),
            'sindrome_metabolico' => fake()->boolean(18),
            'otros' => fake()->optional(0.3)->sentence(),
            'visare_numero' => fake()->optional(0.7)->numberBetween(1, 10),
            'visare_fecha' => fake()->optional(0.7)->dateTimeBetween('-2 years', 'now'),
            'estadio_1_3a_numero' => fake()->optional(0.5)->numberBetween(1, 5),
            'estadio_1_3a_fecha' => fake()->optional(0.5)->dateTimeBetween('-2 years', 'now'),
            'estadio_3b_5_numero' => fake()->optional(0.3)->numberBetween(1, 3),
            'estadio_3b_5_fecha' => fake()->optional(0.3)->dateTimeBetween('-2 years', 'now'),
        ]);
    }

    private function createRiesgo(AdultoMayor $adultoMayor): void
    {
        Riesgo::create([
            'adulto_mayor_id' => $adultoMayor->id,
            'sobrepeso' => fake()->boolean(35),
            'sedentarismo' => fake()->boolean(50),
            'tabaco' => fake()->boolean(15),
            'alcohol' => fake()->boolean(20),
            'estres' => fake()->boolean(30),
            'bajo_peso' => fake()->boolean(10),
            'perimetro_abdominal_aumentado' => fake()->boolean(40),
            'hdl_bajo' => fake()->boolean(25),
        ]);
    }

    private function createEvaluacion(AdultoMayor $adultoMayor): void
    {
        $talla = rand(145, 180);
        $peso = fake()->randomFloat(2, 45, 95);
        $imc = $peso / (($talla / 100) ** 2);

        Evaluacion::create([
            'adulto_mayor_id' => $adultoMayor->id,
            'talla' => $talla,
            'peso_aceptable' => fake()->randomFloat(2, 50, 80),
            'peso' => $peso,
            'presion_arterial' => rand(110, 150) . '/' . rand(70, 95),
            'glucosa' => fake()->randomFloat(2, 70, 180),
            'hb_glicosilada' => fake()->optional(0.6)->randomFloat(2, 4.5, 8.5),
            'imc' => round($imc, 2),
            'perimetro_abdominal' => fake()->randomFloat(2, 70, 120),
            'evaluacion_pie_dm' => fake()->optional(0.4)->randomElement(['Normal', 'Riesgo bajo', 'Riesgo alto']),
            'test_morisky_green' => fake()->optional(0.6)->randomElement(['cumple', 'no cumple']),
            'vacuna_influenza' => fake()->boolean(60),
            'vacuna_neumococo' => fake()->boolean(40),
            'microalbuminuria' => fake()->optional(0.5)->randomFloat(2, 10, 300),
            'creatinina' => fake()->optional(0.5)->randomFloat(2, 0.5, 2.5),
            'tasa_albuminuria_creatinuria' => fake()->optional(0.5)->randomFloat(2, 10, 500),
            'tasa_filtracion_glomerular' => fake()->optional(0.5)->randomFloat(2, 30, 120),
            'control_renal_fecha' => fake()->optional(0.5)->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    private function createValoracion(AdultoMayor $adultoMayor): void
    {
        $autovalente = fake()->boolean(70);
        $fragil = !$autovalente && fake()->boolean(40);

        Valoracion::create([
            'adulto_mayor_id' => $adultoMayor->id,
            'autovalente' => $autovalente,
            'test_barber' => fake()->optional(0.6)->randomElement(['0-2: No riesgo', '3-4: Riesgo moderado', '5+: Alto riesgo']),
            'test_barthel' => fake()->optional(0.6)->randomElement(['100: Independiente', '60-95: Dependencia leve', '40-55: Dependencia moderada', '<40: Dependencia severa']),
            'fragil' => $fragil,
            'test_lawton_brody' => fake()->optional(0.5)->randomElement(['8: Independiente', '4-7: Dependencia moderada', '0-3: Dependencia severa']),
            'test_katz' => fake()->optional(0.5)->randomElement(['A: Independiente', 'B-C: Dependencia leve', 'D-E: Dependencia moderada', 'F-G: Dependencia total']),
            'fecha_enfermeria' => fake()->optional(0.7)->dateTimeBetween('-6 months', 'now'),
            'fecha_medicina' => fake()->optional(0.8)->dateTimeBetween('-6 months', 'now'),
            'fecha_nutricion' => fake()->optional(0.5)->dateTimeBetween('-6 months', 'now'),
            'fecha_psicologia' => fake()->optional(0.4)->dateTimeBetween('-6 months', 'now'),
            'fecha_servicio_social' => fake()->optional(0.4)->dateTimeBetween('-6 months', 'now'),
            'fecha_visita_domiciliaria' => fake()->optional(0.3)->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    private function createCita(AdultoMayor $adultoMayor): void
    {
        $medicos = [
            'Dr. Carlos Mendoza',
            'Dra. Ana García',
            'Dr. Luis Torres',
            'Dra. María Flores',
            'Dr. José Ramírez',
            'Dra. Carmen Silva',
            'Dr. Miguel Ángel Rojas',
            'Dra. Patricia Vargas',
            'Dr. Fernando Castillo',
            'Dra. Rosa Martínez',
            'Dr. Roberto Sánchez',
            'Dra. Isabel Morales',
            'Dr. Ricardo López',
            'Dra. Gloria Hernández',
            'Dr. Andrés Gutiérrez',
            'Dra. Lucía Ramos',
            'Dr. Pedro Fernández',
            'Dra. Teresa González',
            'Dr. Alberto Díaz',
            'Dra. Sofía Muñoz',
            'Dr. Javier Paredes',
            'Dra. Beatriz Campos',
            'Dr. Enrique Vega',
            'Dra. Claudia Reyes',
            'Dr. Manuel Ruiz',
            'Dra. Gabriela Chávez',
            'Dr. Oscar Núñez',
            'Dra. Marina Castro',
            'Dr. Raúl Herrera',
            'Dra. Verónica Jiménez',
        ];

        $enfermeras = [
            'Enf. Rosa Chávez',
            'Enf. Julia Vargas',
            'Enf. Patricia Rojas',
            'Enf. Elena Morales',
            'Enf. Silvia Quispe',
            'Enf. Carmen López',
            'Enf. Luisa Flores',
            'Enf. Mercedes González',
            'Enf. Angela Ramírez',
            'Enf. Yolanda Pérez',
            'Enf. Martha Torres',
            'Enf. Sandra Mendoza',
            'Enf. Miriam Castro',
            'Enf. Cecilia Díaz',
            'Enf. Diana Sánchez',
            'Enf. Nancy Gutiérrez',
            'Enf. Roxana Fernández',
            'Enf. Graciela Vega',
            'Enf. Liliana Herrera',
            'Enf. Mónica Reyes',
            'Enf. Susana Campos',
            'Enf. Pilar Muñoz',
            'Enf. Adriana Núñez',
            'Enf. Victoria Paredes',
            'Enf. Maritza Ruiz',
            'Enf. Isabel Chávez',
            'Enf. Carolina Jiménez',
            'Enf. Fiorella Cortez',
            'Enf. Amparo Medina',
            'Enf. Teresa Salazar',
        ];

        Cita::create([
            'adulto_mayor_id' => $adultoMayor->id,
            'fecha' => fake()->dateTimeBetween('-3 months', '+2 months'),
            'medico' => fake()->optional(0.8)->randomElement($medicos),
            'enfermera' => fake()->optional(0.7)->randomElement($enfermeras),
        ]);
    }

    private function createTratamiento(AdultoMayor $adultoMayor): void
    {
        $medicamentos = [
            'Enalapril' => '10mg cada 12 horas',
            'Losartán' => '50mg cada 24 horas',
            'Metformina' => '850mg cada 12 horas',
            'Atorvastatina' => '20mg cada 24 horas',
            'Aspirina' => '100mg cada 24 horas',
            'Omeprazol' => '20mg cada 24 horas',
            'Ibuprofeno' => '400mg cada 8 horas',
            'Paracetamol' => '500mg cada 8 horas',
            'Amlodipino' => '5mg cada 24 horas',
            'Glibenclamida' => '5mg cada 12 horas',
            'Simvastatina' => '20mg cada 24 horas',
            'Captopril' => '25mg cada 8 horas',
            'Hidroclorotiazida' => '25mg cada 24 horas',
            'Carvedilol' => '12.5mg cada 12 horas',
            'Furosemida' => '40mg cada 24 horas',
            'Espironolactona' => '25mg cada 24 horas',
            'Ranitidina' => '150mg cada 12 horas',
            'Diclofenaco' => '50mg cada 8 horas',
            'Meloxicam' => '15mg cada 24 horas',
            'Tramadol' => '50mg cada 8 horas',
            'Amoxicilina' => '500mg cada 8 horas',
            'Ciprofloxacino' => '500mg cada 12 horas',
            'Prednisona' => '5mg cada 24 horas',
            'Levotiroxina' => '50mcg cada 24 horas',
            'Clonazepam' => '0.5mg cada 12 horas',
            'Fluoxetina' => '20mg cada 24 horas',
            'Warfarina' => '5mg cada 24 horas',
            'Digoxina' => '0.25mg cada 24 horas',
            'Salbutamol' => '100mcg inhalado cada 6 horas',
            'Insulina NPH' => '10 UI subcutánea cada 12 horas',
        ];


        $medicamento = fake()->randomElement(array_keys($medicamentos));

        Tratamiento::create([
            'adulto_mayor_id' => $adultoMayor->id,
            'medicacion' => $medicamento,
            'dosis' => $medicamentos[$medicamento],
        ]);
    }

    private function createActividadesEducativas(AdultoMayor $adultoMayor, int $cantidad): void
    {
        if ($cantidad === 0) {
            return;
        }

        $fechaInicio = fake()->dateTimeBetween('-2 year', '-6 months');
        $fechaAnterior = null;

        for ($i = 1; $i <= $cantidad; $i++) {
            if ($i === 1) {
                $fecha = $fechaInicio;
            } else {
                $diasSiguientes = rand(7, 21);
                $fecha = (new \DateTime($fechaAnterior->format('Y-m-d')))
                    ->modify("+{$diasSiguientes} days");
            }

            ActividadEducativa::create([
                'adulto_mayor_id' => $adultoMayor->id,
                'fecha' => $fecha,
                'numero_sesion' => 'Sesión ' . $i,
            ]);

            $fechaAnterior = $fecha;
        }
    }
}

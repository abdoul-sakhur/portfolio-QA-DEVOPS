<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    public function definition(): array
    {
        $startYear = fake()->numberBetween(2010, 2020);

        return [
            'degree' => fake()->randomElement([
                'Master Qualité Logicielle & Test', 'Licence Informatique',
                'BTS Services Informatiques', 'Master DevOps & Cloud',
                'Diplôme d\'Ingénieur Logiciel',
            ]),
            'school' => fake()->randomElement([
                'Université Paris-Saclay', 'Université de Cergy-Pontoise',
                'EPITECH', 'CNAM', 'Université Lyon 1',
            ]),
            'start_year' => $startYear,
            'end_year' => $startYear + fake()->numberBetween(1, 3),
            'description' => fake()->sentence(15),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-8 years', '-1 years');
        $isCurrent = fake()->boolean(20);

        return [
            'title' => fake()->randomElement([
                'QA Engineer', 'Testeur Logiciel', 'Ingénieur Automatisation',
                'DevOps Engineer', 'SDET', 'Lead QA', 'Consultant QA',
            ]),
            'company' => fake()->company(),
            'start_date' => $start,
            'end_date' => $isCurrent ? null : fake()->dateTimeBetween($start, 'now'),
            'is_current' => $isCurrent,
            'description' => implode("\n", fake()->sentences(3)),
            'order' => fake()->numberBetween(0, 50),
        ];
    }
}

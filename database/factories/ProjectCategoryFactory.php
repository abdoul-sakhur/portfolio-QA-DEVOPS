<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Automatisation', 'CI/CD', 'Performance', 'Sécurité', 'Mobile Testing', 'API Testing',
        ]) . ' ' . fake()->unique()->numerify('####');

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'color' => fake()->hexColor(),
        ];
    }
}

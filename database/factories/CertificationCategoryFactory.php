<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CertificationCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Cloud', 'QA', 'Agilité', 'Sécurité', 'DevOps',
        ]) . ' ' . fake()->unique()->numerify('####');

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}

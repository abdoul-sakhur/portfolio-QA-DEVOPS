<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'QA', 'DevOps', 'Automatisation', 'Sécurité', 'Cloud', 'Agilité',
        ]) . ' ' . fake()->unique()->numerify('####');

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}

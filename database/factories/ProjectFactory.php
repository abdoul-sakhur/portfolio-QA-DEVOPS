<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->catchPhrase() . ' ' . fake()->unique()->numerify('####');

        return [
            'title' => $title,
            'description' => fake()->paragraph(4),
            'cover_image' => null,
            'url' => fake()->optional()->url(),
            'github_url' => fake()->optional()->url(),
            'category_id' => ProjectCategoryFactory::new(),
            'is_featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(0, 50),
            'client' => fake()->optional()->company(),
            'challenge' => fake()->optional()->paragraph(2),
            'solution' => fake()->optional()->paragraph(2),
            'results' => fake()->optional()->paragraph(2),
            'mission_duration' => fake()->optional()->randomElement(['2 semaines', '1 mois', '3 mois', '6 mois']),
        ];
    }
}

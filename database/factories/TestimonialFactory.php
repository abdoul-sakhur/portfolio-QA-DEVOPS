<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_name' => fake()->name(),
            'client_company' => fake()->optional()->company(),
            'client_role' => fake()->optional()->jobTitle(),
            'client_photo' => null,
            'content' => fake()->paragraph(3),
            'rating' => fake()->numberBetween(3, 5),
            'is_published' => fake()->boolean(80),
            'order' => fake()->numberBetween(0, 50),
        ];
    }
}

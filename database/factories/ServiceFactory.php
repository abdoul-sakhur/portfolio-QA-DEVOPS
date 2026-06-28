<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'Audit QA & Stratégie de Tests', 'Automatisation des Tests', 'Mise en place CI/CD',
                'Tests de Performance', 'Formation & Coaching QA', 'Audit de Sécurité Applicative',
            ]) . ' ' . fake()->unique()->numerify('####'),
            'icon' => null,
            'short_description' => fake()->sentence(20),
            'description' => implode("\n", fake()->sentences(4)),
            'price_label' => fake()->randomElement(['Sur devis', 'À partir de 500€', 'À partir de 800€']),
            'duration' => fake()->randomElement(['1-2 semaines', '2-4 semaines', '2-6 semaines', '1-5 jours']),
            'is_featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(0, 50),
        ];
    }
}

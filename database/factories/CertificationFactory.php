<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CertificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement([
                'ISTQB Foundation Level', 'ISTQB Advanced Level', 'AWS Certified Cloud Practitioner',
                'AWS Certified DevOps Engineer', 'Professional Scrum Master I',
                'Certified Kubernetes Administrator', 'Azure Fundamentals',
            ]) . ' ' . fake()->unique()->numerify('####'),
            'issuer' => fake()->randomElement(['ISTQB', 'Amazon Web Services', 'Scrum.org', 'Microsoft', 'CNCF']),
            'issue_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'credential_url' => fake()->optional()->url(),
            'cover_image' => null,
            'category_id' => CertificationCategoryFactory::new(),
        ];
    }
}

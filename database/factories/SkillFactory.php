<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Selenium', 'Cypress', 'Playwright', 'Postman', 'JMeter', 'k6',
                'Docker', 'Kubernetes', 'Jenkins', 'GitLab CI', 'GitHub Actions',
                'Ansible', 'Terraform', 'Grafana', 'Prometheus', 'SonarQube',
                'Jira', 'Git', 'Bash', 'Python', 'PHPUnit',
            ]) . ' ' . fake()->unique()->numerify('####'),
            'icon' => null,
            'level' => fake()->numberBetween(40, 100),
            'category' => fake()->randomElement([
                'Automatisation', 'API Testing', 'Performance', 'DevOps', 'CI/CD', 'Gestion', 'Outils',
            ]),
            'order' => fake()->numberBetween(0, 50),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    public function definition(): array
    {
        $isPublished = fake()->boolean(80);

        return [
            'title' => fake()->sentence(6) . ' ' . fake()->unique()->numerify('####'),
            'excerpt' => fake()->sentence(20),
            'content' => implode("\n\n", fake()->paragraphs(5)),
            'cover_image' => null,
            'category_id' => BlogCategoryFactory::new(),
            'is_published' => $isPublished,
            'published_at' => $isPublished ? fake()->dateTimeBetween('-1 year', 'now') : null,
        ];
    }
}

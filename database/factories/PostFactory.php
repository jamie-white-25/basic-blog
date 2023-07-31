<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'user_id' => 1,
            // 'email_sent' => null,
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => 'blog/default.jpg',
            'body' => fake()->paragraphs(10, true),
        ];
    }
}

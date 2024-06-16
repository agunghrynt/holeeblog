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
        $titleArr = fake()->words(mt_rand(3, 8));
        $title = implode(' ', $titleArr);
        $slug = Str::slug($title);

        return [
            //
            'title' => $title,
            'slug' => $slug,
            'excerpt' => fake()->paragraph(),
            // 'body' => '<p>' . implode('</p><p>', fake()->paragraphs(mt_rand(5, 10))) . '</p>',
            'body' => collect(fake()->paragraphs(mt_rand(5, 10)))
                        ->map(function($p) {
                            return "<p>$p</p>";
                        })
                        ->implode(''),
            'user_id' => mt_rand(1, 12),
            'category_id' => mt_rand(1, 3),
        ];
    }
}

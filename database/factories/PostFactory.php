<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(3, 6)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(mt_rand(1, 1)),
            'body' => collect($this->faker->paragraphs(mt_rand(5, 10)))
            ->map(fn($p) => "<p>$p</p>")
            ->implode(''),
            'img' => null,
            'user_id' => mt_rand(1, 3),
            'category_id' => mt_rand(1,3)
        ];
    }
}

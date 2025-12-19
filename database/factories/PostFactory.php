<?php

namespace Database\Factories;

use App\Models\Category;
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
    $title = $this->faker->sentence(); // Changed from fake()
    return [
        'image' => $this->faker->imageUrl(), // Changed from fake()
        'title' => $title,
        'slug' => \Illuminate\Support\Str::slug($title),
        'content' => $this->faker->paragraphs(5, true), // Changed from fake()
        'category_id' => Category::inRandomOrder()->first()->id,
        'user_id' => 1,
        'published_at' => $this->faker->optional()->dateTime(), // Changed from fake()
    ];
}
}

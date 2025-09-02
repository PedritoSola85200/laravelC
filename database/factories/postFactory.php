<?php

namespace Database\Factories;

use App\Models\category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\post>
 */
class postFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'image_path' => $this->faker->imageUrl(),
            'excerpt' => $this->faker->paragraph(),
            'concept' => $this->faker->paragraph(20, true),
            'is_published' => $this->faker->boolean(false),
            'published_at' => $this->faker->dateTime(),
            'user_id' => User::all()->random()->id,
            'category_id' => category::all()->random()->id,
        ];
    }
}

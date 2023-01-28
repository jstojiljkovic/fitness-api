<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organisation_id' => Organisation::factory(),
            'user_id' => User::factory(),
            'name' => fake()->words(5, true),
            'description' => fake()->text(),
            'filename' => fake()->imageUrl(),
            'source' => fake()->words(15, true),
            'thumbnail' => fake()->imageUrl(),
        ];
    }
}

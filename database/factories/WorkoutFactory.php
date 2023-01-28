<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workout>
 */
class WorkoutFactory extends Factory
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
            'video_id' => Video::factory(),
            'name' => fake()->words(5, true),
            'description' => fake()->text(),
            'duration' => fake()->randomNumber(),
            'filename' => fake()->imageUrl(),
            'thumbnail' => fake()->imageUrl(),
        ];
    }
}

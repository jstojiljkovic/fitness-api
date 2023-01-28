<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class StepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'video_id' => Video::factory(),
            'name' => fake()->words(5, true),
            'description' => fake()->text(),
            'start' => fake()->randomFloat(25),
            'end' => fake()->randomFloat(25)
        ];
    }
}

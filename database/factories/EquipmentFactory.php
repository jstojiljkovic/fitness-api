<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Equipment>
 */
class EquipmentFactory extends Factory
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
            'name' => fake()->name(),
            'description' => fake()->text(),
            'filename' => fake()->image(),
            'thumbnail' => fake()->image(null, 360, 203),
        ];
    }
}

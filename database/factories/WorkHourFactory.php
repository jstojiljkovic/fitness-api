<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkHour>
 */
class WorkHourFactory extends Factory
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
            'day' => fake()->numberBetween(1,7),
            'start' => '09:00',
            'end' => '15:00',
        ];
    }
}

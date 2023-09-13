<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TimesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'athlete_id' => $this->faker->numberBetween(92, 116),
            'modality_id' => $this->faker->numberBetween(1, 4),
            'day' => now(),
            'pool' => 50,
            'distance' => 50,
            'type_time' => 'tomada',
            'record' => $this->faker->randomFloat(2, 21, 50),
            'code' => $this->faker->uuid,
            'updated_by' => $this->faker->userName,
            'created_by' => $this->faker->userName,
        ];
    }
}

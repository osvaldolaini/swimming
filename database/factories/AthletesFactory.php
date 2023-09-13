<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AthletesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'active' => $this->faker->boolean(100), // Probabilidade de estar ativo
            'sex' => $this->faker->randomElement(['masculino', 'feminino']), // Gere sexo aleatório
            'name' => $this->faker->name,
            'nick' => $this->faker->userName,
            'birth' => $this->faker->date('Y-m-d', '2003-12-31'),
            'slug' => $this->faker->slug,
            'code' => $this->faker->uuid,
        ];
    }
}

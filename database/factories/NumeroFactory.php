<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Numero;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Numero>
 */
class NumeroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero' => $this->faker->unique()->numberBetween($min = 000, $max = 999),
            'participante_id' => NULL,
            'vendedor_id' => NULL,
        ];
    }
}

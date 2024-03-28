<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progresse>
 */
class ProgresseFactory extends Factory
{
    /**
     * Define the model's default state.
    
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'weight' => $this->faker->numberBetween(50, 100),
            'measurements' => json_encode(['height' => $this->faker->numberBetween(150, 200)]),
            'performance' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Non terminé', 'Terminé']),
            'user_id' => null, 
        ];
    }
}
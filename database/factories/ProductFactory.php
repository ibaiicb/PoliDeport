<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'stock' => $this->faker->randomNumber(3),
            'type_id' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->realTextBetween(10, 50),
            'price' => $this->faker->randomFloat(2, 0, 500),
            'updated_at' => now(),
            'created_at' => now()
        ];
    }
}

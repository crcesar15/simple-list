<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'name' => $this->faker->name,
            'description' => $this->faker->text(20),
            'code' => $this->faker->randomNumber(6),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
